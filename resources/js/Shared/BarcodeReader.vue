<template>
    <div class="quagga-code-reader"></div>
</template>

<script>
import Quagga from '@ericblade/quagga2';

export default {
    emits: ['detected'],
    name: "BarcodeReader",
    props: {
        visible: Boolean
    },
    mounted() {
        if(this.visible) this.initQuagga()
    },
    methods: {
        initQuagga() {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: this.$el
                },
                decoder: {
                    readers: ["code_128_reader"]
                }
            }, function (err) {
                if (err) {
                    console.log(err);
                    return
                }

                console.log("Initialization finished. Ready to start");

                Quagga.start();
            });

            Quagga.onDetected((data) => {
                this.$emit('detected', data.codeResult.code)

                Quagga.stop();
                Quagga.offDetected()
            })
        }
    },
    unmounted() {
        Quagga.stop();
    },
    watch: {
        visible(status) {
            if(status) {
                this.initQuagga()
            } else {
                Quagga.stop()
                Quagga.offDetected()
            }
        }
    }
}
</script>

<style lang="scss">
.quagga-code-reader {
    position: relative;

    & video {
        width: 100%;
        object-fit: cover;
    }

    & canvas {
        display: none;
    }
}

.drawingBuffer {
    position: absolute;
    top: 0;
    left: 0;
}
</style>
