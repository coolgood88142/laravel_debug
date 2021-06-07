<template>
    <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <slot name="header">
                        <h3>{{ message }}</h3>
                    </slot>
                </div>
                <div class="modal-footer">
                    <slot name="footer">
                        <div class="form-check form-check-inline">
                            <input type="button" class="btn btn-primary" id="save" name="save" value="確認" @click="$emit('close')">
                        </div>
                    </slot>
                </div>
            </div>
          </div>
        </div>
      </transition>
</template>

<script>
export default {
     props:{
         message:{
             type:String
         }
     }
}
</script>>