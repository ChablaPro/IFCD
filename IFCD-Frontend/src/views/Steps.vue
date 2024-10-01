<template>
    <div>
        <Steps :current="current" size="small">
          <Step title="Key Information"></Step>
          <Step title="Additional Information (Submit)"></Step>
        </Steps>
    </div>
</template>

<script>
import "view-design/dist/styles/iview.css";
	export default ({
        props:{
           current: 0
        },
		data() {
			return {
			}
		},
	})

</script>