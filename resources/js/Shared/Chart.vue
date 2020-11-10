<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  props: ['data', 'options'],
  mounted () {
    this.renderChart(
      {
        labels: Array.from(new Set(this.data[2])),
        datasets: [
          {
            label: 'Ready to Send',
            backgroundColor: '#75DA8B',
            data: this.data[1]
          },
        	{
        		label: 'Sent',
	          backgroundColor: '#0000FF',
	          data: this.data[0]
          }
        ]
      },
      this.options
    );
  }
};
</script>

<style>
</style>