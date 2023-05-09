<template>
    <div class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div v-if="!noHeader" class="modal-header">
            <span class="modal-title" v-html="title"></span>
            <button type="button" class="close" data-bs-dismiss="modal" @click="close()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <slot></slot>
          </div>
          <div v-if="!noFooter" class="modal-footer">
            <slot name="footer">
                <Vbutton type="button" class="btn btn-primary" @click="onConfirm">Save changes</Vbutton>
                <Vbutton type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</Vbutton>
            </slot>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
    export default {
        props: {
            confirmText: {
                type: String,
                default: 'Confirm',
            },
            cancelText: {
                type: String,
                default: 'Cancel',
            },
            title: {
                type: String,
                default: 'Título'
            },
            noHeader: {
                type: Boolean,
                default: false
            },
            noFooter: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            onConfirm() {
                this.$emit('confirm');
            },
            close() {
                this.$emit('close');
            }
        }
    }
</script>