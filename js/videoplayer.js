class BootstrapVideoplayer {

    constructor(selector, settingsCustom) {

        let settingsDefault = {
            selectors: {
                video: '.video',
                playPauseButton: '.btn-video-playpause',
                playIcon: '.bi-play-fill',
                pauseIcon: '.bi-pause-fill',
                progress: '.progress',
                progressbar: '.progress-bar',
                pipButton: '.btn-video-pip',
                fullscreenButton: '.btn-video-fullscreen',
                volumeRange: '.form-range-volume'
            },
            youtube: {
                autoplay: 1,
                mute: 1,
                controls: 0,
                rel: 0,
                modestbranding: 1,
                playsinline: 1
            }
        };

        function deepMerge(target, ...sources) {
            if (!sources.length) return target;
            const source = sources.shift();
            if (typeof target === 'object' && typeof source === 'object') {
                for (let key in source) {
                    if (source.hasOwnProperty(key)) {
                        if (Object.prototype.toString.call(source[key]) === '[object Object]') {
                            if (!target[key]) Object.assign(target, { [key]: {} });
                            deepMerge(target[key], source[key]);
                        } else {
                            Object.assign(target, { [key]: source[key] });
                        }
                    }
                }
            }
            return deepMerge(target, ...sources);
        }

        let settings = deepMerge({}, settingsDefault, settingsCustom || {});
        let playerRoot = document.querySelector('#' + selector);
        if (!playerRoot) return;

        let videoEl = playerRoot.querySelector(settings.selectors.video);
        let progress = playerRoot.querySelector(settings.selectors.progress);
        let progressbar = playerRoot.querySelector(settings.selectors.progressbar);
        let playbutton = playerRoot.querySelector(settings.selectors.playPauseButton);
        let pipbutton = playerRoot.querySelector(settings.selectors.pipButton);
        let fullscreenbutton = playerRoot.querySelector(settings.selectors.fullscreenButton);
        let volumeinput = playerRoot.querySelector(settings.selectors.volumeRange);

        // --- Detecta modo ---
        const isNativeVideo = videoEl && videoEl.tagName && videoEl.tagName.toLowerCase() === 'video';
        const youtubeId = playerRoot.dataset.youtubeId ? playerRoot.dataset.youtubeId.trim() : '';

        if (isNativeVideo) {
            // ===============================
            // MODO ORIGINAL (MP4 / <video>)
            // ===============================

            const parent = this;

            try {
                videoEl.addEventListener('error', function (e) {
                    console.log('Bootstrap Video Player: error cargando el vídeo', e);
                });

                videoEl.addEventListener('loadedmetadata', function () {
                    videoEl.volume = (volumeinput.value / 100);
                });

                playbutton.addEventListener('click', function () {
                    parent.playpauseNative(videoEl, this, progressbar);
                });

                videoEl.addEventListener('click', function () {
                    parent.playpauseNative(videoEl, playbutton, progressbar);
                });

                pipbutton.addEventListener('click', function () {
                    parent.pipNative(videoEl);
                });

                progress.addEventListener('click', function (e) {
                    let width = this.clientWidth;
                    let bounds = this.getBoundingClientRect();
                    let x = e.clientX - bounds.left;
                    let percent = Math.floor((x / width) * 100);
                    videoEl.currentTime = ((percent * videoEl.duration) / 100);
                    progressbar.style.width = percent + '%';
                });

                fullscreenbutton.addEventListener('click', function () {
                    parent.openFullscreen(playerRoot);
                });

                volumeinput.addEventListener('input', function () {
                    videoEl.volume = (this.value / 100);
                });

            } catch (e) {
                console.log('Bootstrap Video Player: error inicializando player MP4', e);
            }

            return;
        }

        // ===============================
        // MODO YOUTUBE (IFrame API)
        // ===============================
        if (!youtubeId) {
            console.log('Bootstrap Video Player: falta data-youtube-id en #' + selector);
            return;
        }

        // PIP no aplica a YouTube: lo desactivamos visualmente (sin tocar HTML)
        if (pipbutton) pipbutton.style.display = 'none';

        const parent = this;
        this.ytPlayer = null;
        this._rafId = null;

        BootstrapVideoplayer._loadYouTubeAPI().then(() => {
            parent.ytPlayer = new YT.Player(videoEl, {
                videoId: youtubeId,
                playerVars: settings.youtube,
                events: {
                    onReady: (e) => {
                        // Ajuste volumen inicial según slider
                        if (volumeinput) {
                            const v = parseInt(volumeinput.value, 10);
                            e.target.setVolume(isNaN(v) ? 0 : v);
                        } else {
                            e.target.setVolume(0);
                        }

                        // Asegurar mute para autoplay
                        if (settings.youtube.mute === 1) e.target.mute();

                        // Autoplay (si está permitido)
                        if (settings.youtube.autoplay === 1) {
                            e.target.playVideo();
                            parent._setPlayIcons(playbutton, true);
                            parent._startYouTubeProgress(progressbar);
                        }
                    },
                    onStateChange: (e) => {
                        // PLAYING = 1, PAUSED = 2, ENDED = 0
                        if (e.data === YT.PlayerState.PLAYING) {
                            parent._setPlayIcons(playbutton, true);
                            parent._startYouTubeProgress(progressbar);
                        }
                        if (e.data === YT.PlayerState.PAUSED) {
                            parent._setPlayIcons(playbutton, false);
                            parent._stopYouTubeProgress();
                        }
                        if (e.data === YT.PlayerState.ENDED) {
                            parent._setPlayIcons(playbutton, false);
                            parent._stopYouTubeProgress();
                            if (progressbar) progressbar.style.width = '0%';
                        }
                    }
                }
            });

            // Play/Pause
            if (playbutton) {
                playbutton.addEventListener('click', function () {
                    parent.playpauseYouTube(this, progressbar);
                });
            }

            // Click en “video”
            if (videoEl) {
                videoEl.addEventListener('click', function () {
                    parent.playpauseYouTube(playbutton, progressbar);
                });
            }

            // Progreso (seek)
            if (progress) {
                progress.addEventListener('click', function (e) {
                    if (!parent.ytPlayer) return;
                    const duration = parent.ytPlayer.getDuration();
                    if (!duration) return;

                    let width = this.clientWidth;
                    let bounds = this.getBoundingClientRect();
                    let x = e.clientX - bounds.left;
                    let percent = Math.floor((x / width) * 100);
                    let targetTime = (percent * duration) / 100;
                    parent.ytPlayer.seekTo(targetTime, true);
                    if (progressbar) progressbar.style.width = percent + '%';
                });
            }

            // Fullscreen (del contenedor del player)
            if (fullscreenbutton) {
                fullscreenbutton.addEventListener('click', function () {
                    parent.openFullscreen(playerRoot);
                });
            }

            // Volumen (0-100)
            if (volumeinput) {
                volumeinput.addEventListener('input', function () {
                    if (!parent.ytPlayer) return;
                    const v = parseInt(this.value, 10);
                    parent.ytPlayer.setVolume(isNaN(v) ? 0 : v);

                    if (v === 0) parent.ytPlayer.mute();
                    else parent.ytPlayer.unMute();
                });
            }

        }).catch(err => {
            console.log('Bootstrap Video Player: no se pudo cargar YouTube API', err);
        });
    }

    // ---------- Helpers comunes ----------
    _setPlayIcons(button, isPlaying) {
        if (!button) return;
        const playI = button.querySelector('.bi-play-fill');
        const pauseI = button.querySelector('.bi-pause-fill');
        if (!playI || !pauseI) return;

        if (isPlaying) {
            playI.classList.add('d-none');
            pauseI.classList.remove('d-none');
        } else {
            playI.classList.remove('d-none');
            pauseI.classList.add('d-none');
        }
    }

    openFullscreen(element) {
        if (!element) return;
        if (element.requestFullscreen) element.requestFullscreen();
        else if (element.webkitRequestFullscreen) element.webkitRequestFullscreen();
        else if (element.msRequestFullscreen) element.msRequestFullscreen();
    }

    // ---------- MODO MP4 ----------
    playpauseNative(video, button, progressbar) {
        if (!video) return;

        if (!video.paused) {
            video.pause();
            this._setPlayIcons(button, false);
        } else {
            video.play().catch(error => console.log('Error reproduciendo el vídeo:', error));
            this._setPlayIcons(button, true);
            requestAnimationFrame(() => { this.updateProgressBarNative(video, button, progressbar) });
        }
    }

    updateProgressBarNative(video, button, progressbar) {
        if (!video || !progressbar) return;
        let percentPlayed = Math.floor((video.currentTime / (video.duration / 100)));
        if (percentPlayed < 100) {
            progressbar.style.width = percentPlayed + '%';
            requestAnimationFrame(() => { this.updateProgressBarNative(video, button, progressbar) });
        } else if (percentPlayed === 100) {
            progressbar.style.width = '100%';
            video.pause();
            video.currentTime = 0;
            this._setPlayIcons(button, false);
        }
    }

    async pipNative(video) {
        if (!video) return;
        try {
            if (document.pictureInPictureElement) {
                await document.exitPictureInPicture();
            } else {
                await video.requestPictureInPicture();
            }
        } catch (e) {
            console.log('PIP no disponible o error:', e);
        }
    }

    // ---------- MODO YOUTUBE ----------
    playpauseYouTube(button, progressbar) {
        if (!this.ytPlayer) return;

        const state = this.ytPlayer.getPlayerState();
        if (state === YT.PlayerState.PLAYING) {
            this.ytPlayer.pauseVideo();
            this._setPlayIcons(button, false);
            this._stopYouTubeProgress();
        } else {
            this.ytPlayer.playVideo();
            this._setPlayIcons(button, true);
            this._startYouTubeProgress(progressbar);
        }
    }

    _startYouTubeProgress(progressbar) {
        this._stopYouTubeProgress();
        const tick = () => {
            if (!this.ytPlayer || !progressbar) return;

            const duration = this.ytPlayer.getDuration();
            if (!duration) {
                this._rafId = requestAnimationFrame(tick);
                return;
            }

            const current = this.ytPlayer.getCurrentTime();
            const percent = Math.min(100, Math.max(0, (current / duration) * 100));
            progressbar.style.width = percent + '%';

            this._rafId = requestAnimationFrame(tick);
        };
        this._rafId = requestAnimationFrame(tick);
    }

    _stopYouTubeProgress() {
        if (this._rafId) {
            cancelAnimationFrame(this._rafId);
            this._rafId = null;
        }
    }

    // ---------- Cargar API una sola vez ----------
    static _loadYouTubeAPI() {
        if (BootstrapVideoplayer._ytPromise) return BootstrapVideoplayer._ytPromise;

        BootstrapVideoplayer._ytPromise = new Promise((resolve, reject) => {
            if (window.YT && window.YT.Player) {
                resolve();
                return;
            }

            const tag = document.createElement('script');
            tag.src = 'https://www.youtube.com/iframe_api';
            tag.async = true;

            tag.onerror = () => reject(new Error('No se pudo cargar iframe_api'));

            const firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            window.onYouTubeIframeAPIReady = () => resolve();
        });

        return BootstrapVideoplayer._ytPromise;
    }
}
