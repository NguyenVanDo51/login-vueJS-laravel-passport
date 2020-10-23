<template>
  <div :style="{
    width: `${persent}%`,
    height: height,
    opacity: show ? 1:0,
    'background-color': canSuccess ? color : failedColor
  }" class="progress">
  </div>
</template>
<script>

</script>