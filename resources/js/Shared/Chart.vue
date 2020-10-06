<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  props: ['data', 'options'],
  mounted () {
    // this.renderChart(this.chartdata, this.options)
    // console.log(this.data);
    let newData    = [];
    let newLabels  = [];
    this.data.reverse().forEach(d => {
                    newData.push(d.total);
                    newLabels.push(d.month);
                });

    this.renderChart(
      {
        labels: newLabels,
        datasets: [
        	{
        		label: 'Invoices',
	            backgroundColor: '#0000FF',
	            data: newData
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