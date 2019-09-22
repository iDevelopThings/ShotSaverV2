<template>

    <div>

        <transition
            name="fade"
            enter-active-class="animated fadeInUp"
            leave-active-class="animated fadeInOut" mode="out-in">
            <div v-if="currentStage !== null">
                <h5 class="mb-3">{{stage.title}}</h5>

                <div v-if="currentStage === 'preparing'">
                    <i class="fas fa-spin fa-spinner"></i>
                </div>
                <div v-else-if="currentStage === 'complete'">
                    <i class="fas fa-spin fa-spinner"></i>
                    <p>Upload complete... refreshing page </p>
                </div>
                <div v-else>

                    <div class="progress">
                        <div class="progress-bar"
                             role="progressbar"
                             :style="`width: ${stage.progress}%;`"
                             :aria-valuenow="stage.progress"
                             aria-valuemin="0"
                             aria-valuemax="100">{{stage.progress}}%
                        </div>
                    </div>
                </div>
            </div>
        </transition>

    </div>

</template>

<script>
    import Ws from '@adonisjs/websocket-client'

    export default {
        name     : "FileProcessing",
        props    : ['fileId'],
        mounted()
        {

            console.log(process.env.NODE_ENV);
            this.ws = Ws(process.env.NODE_ENV === 'development' ? 'ws://localhost:3333' : 'wss://processing.shotsaver.io');
            this.ws.connect();

            this.subscription = this.ws.subscribe('file:' + this.fileId);

            this.subscription.on('progress', (data) => {
                console.log(data);

                if (this.currentStage !== data.type)
                    this.currentStage = null;

                if (data.type === 'complete') {
                    this.progressStages.complete.progress = 100;
                    window.location                       = window.location;
                    return;
                }

                this.progressStages[data.type].progress = parseInt(data.progress);

                setTimeout(() => {
                    this.currentStage = data.type;
                }, 500)
            });

            this.currentStage = 'preparing';
        },
        computed : {
            stage()
            {
                return this.progressStages[this.currentStage];
            }
        },
        data()
        {
            return {
                ws             : null,
                subscription   : null,
                currentStage   : null,
                progressStages : {
                    preparing          : {
                        title : 'Preparing...'
                    },
                    hdTranscode        : {
                        title    : 'Creating HD Version...',
                        progress : 0,
                    },
                    sdTranscode        : {
                        title    : 'Creating LD Version...',
                        progress : 0,
                    },
                    thumbnailTranscode : {
                        title    : 'Creating Thumbnails...',
                        progress : 0,
                    },
                    uploadFiles        : {
                        title    : 'Storing Videos...',
                        progress : 0,
                    },
                    complete           : {
                        title    : 'Complete',
                        progress : 0,
                    }
                }
            };
        },
        methods  : {}
    }
</script>

<style scoped lang="scss">

</style>
