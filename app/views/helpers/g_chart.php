<?php
/**
 * CakePHP helper that acts as a wrapper for Google's Visualization JS Package.
 */
class GChartHelper extends AppHelper {
	public $helpers = array('Html', 'Session', 'Javascript');

	/**
	* Available visualization types
	*
	* @var array
	*/
	private $chart_types = array(
		'area' => array(
			'method'=>'AreaChart',
			'data_method'=>'setValue',
			'package' => 'corechart'
		),
		'bar' => array(
			'method' => 'BarChart',
			'data_method' => 'setValue',
			'package' => 'corechart'
		),
		'column' => array(
			'method' => 'ColumnChart',
			'data_method' => 'setValue',
			'package' => 'corechart'
		),
		'pie' => array(
			'method' => 'PieChart',
			'data_method' => 'setValue',
			'package' => 'corechart'
		),
		'line' => array(
			'method' => 'LineChart',
			'data_method' => 'setValue',
			'package' => 'corechart'
		),
		'table' => array(
			'method' => 'Table',
			'data_method' => 'setCell',
			'package' => 'table'
		),
		'geochart' => array(
			'method' => 'GeoChart',
			'data_method' => 'setValue',
			'package' => 'geochart'
		),
		'motionchart' => array(
			'method' => 'MotionChart',
			'data_method' => 'setValue',
			'package' => 'motionchart'
		),
		'chartwrapper' => array(
			'method' => 'ChartWrapper',
			'data_method' => 'setValue',
			'package' => 'chartwrapper'
		)
	);

	private $packages_loaded = array();

	/**
	 * Default options
	 *
	 * @var array
	 */
	private $defaults = array(
		'title' => '',
		'type' => 'area',
		'width' => 780,
		'height' => 250,
		'is3D' => 'true',
		'legend' => 'bottom'
	);

	/**
	 * Creates a div tag meant to be filled with the Google visualization.
	 *
	 * @param string $name
	 * @param array $options
	 * @return string Div tag output
	 */
	public function start($name, $options=array()) {
		$options = array_merge(array('id' => $name), $options);
		$o = $this->Html->tag('div', '', $options);
		return $o;
	}

	/**
	 * Returns javascript that will create the visualization requested.
	 *
	 * @param string $name
	 * @param array $data
	 * @return string
	 */
	public function visualize($name, $data=array()) {
		$data = array_merge($this->defaults, $data);

		$o = $this->loadPackage($data['type']);
		$o.= '<script type="text/javascript">
			function drawChart'.$name.'() {
			var data = new google.visualization.DataTable();
		';
// 		pr($data);
		$o.= $this->loadDataAndLabels($data, $data['type']);
		$o.= $this->instantiateGraph($name, $data['type']);
		$o.= "chart.draw(data, {width: {$data['width']}, height: {$data['height']}, is3D: {$data['is3D']}, legend: '{$data['legend']}', title: '{$data['title']}'});";
		$o.= "}";
		$o.= "google.setOnLoadCallback(drawChart$name);";
		$o.= "</script>";
		
// 		pr($data);
		return $o;
   }

	/**
	 * Returns javascript that adds the data and label to be used in the visualization.
	 *
	 * @param array $data
	 * @param string $graph_type
	 * @return string
	 */
	private function loadDataAndLabels($data, $graph_type) {
// 		pr($data);
		$o = '';
		foreach($data['labels'] as $label) {
// 			pr($label);
			foreach($label as $type => $label_name) {
				if($type == 'role'){
				  $o.= "data.addColumn( {type:'string', $type : '$label_name'});\n";
				}else{
				  $o.= "data.addColumn('$type', '$label_name');\n";
				}
			}
		}
		$data_count = count($data['data']);
		$label_count = count($data['labels']);
		$o.= "data.addRows($data_count);\n";
		for($i = 0; $i < $data_count; $i++) {
			for($j=0; $j < $label_count; $j++) {
				$value = $data['data'][$i][$j]; 
				$type = key($data['labels'][$j]);
				  if($type == 'string') {
					$o.= "data.{$this->chart_types[$graph_type]['data_method']}($i, $j, '$value');\n";
				  } else {
					$o.= "data.{$this->chart_types[$graph_type]['data_method']}($i, $j, $value);\n";
				  }

			}
		}
// 		pr($o);
		return $o;
	}

	/**
	 * Loads the specific visualization package.  Will only load a package once.
	 *
	 * @param string $type
	 * @return string
	 */
	private function loadPackage($type) {
		$o = '';
		if(!in_array($this->chart_types[$type]['package'], $this->packages_loaded)) {
			$o.= '<script type="text/javascript">'."\n";
			$o.= 'google.load("visualization", "1", {packages:["'.$this->chart_types[$type]['package'].'"]});'."\n";
			$o.= '</script>'."\n";
			$this->packages_loaded[] = $this->chart_types[$type]['package'];
		}
// 		exit();
		return $o;
	}

	/**
	 * Returns javascript to instantiate the Google visualization package.
	 *
	 * @param string $name
	 * @param string $type
	 * @return string
	 */
	private function instantiateGraph($name, $type='area') {
		$o = "var chart = new google.visualization.{$this->chart_types[$type]['method']}(document.getElementById('$name'));";
		return $o;
	}
}
