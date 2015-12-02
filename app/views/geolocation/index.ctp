<?php
/**
@A simple explanation:

points is the array where your store, guess, points! The map methos writes out the js for the map, the addMarkers method add markers to the page. The last method, moveMarkerOnClick, was useful to me, for user placement. With this code you can create a map where the user can click to move the marker. Note that the marker which moves is always the one called marker0. The two methos parameters are the ids of two input boxes, representing latitude and longitude. This id is created automatically by CakePHP by using the usual syntax ControllernameInputname.  The default variable contains map type, zoom level, center of the map respectively. You can also add directions to your map by adding a div, setting and id for it and then passing the id in the default array like this:

ALERT => 'directions_div'=>'directions_div'

You can also use the addMarkerOnClick function, which adds a marker when you click on the map. InfoWindows are supported, just add a title and html item to the point array, they will be used to create an infowindow to be displayed when you click on the marker icon.

Hope this helps!

PS: please not that this is a initial version of the helper, use it at your own risk! But please leave here some comments, feature request, bug, or else!

Thanks!
*/

?>
<?php
 $default = array('type'=>'0','zoom'=>14,'lat'=>'19.455748','long'=>'-96.960526');
        $points = array();
        $points[0]['Point'] = array('longitude' =>$default['long'],'latitude' =>$default['lat']);
        $key = $this->GoogleMap->key;
        echo $javascript->link($this->GoogleMap->url);
        echo $this->GoogleMap->map($default,'width: 1024px; height: 540px');
        echo $this->GoogleMap->addMarkers($points);
        echo $this->GoogleMap->moveMarkerOnClick('StructureLongitudine','StructureLatitudine');
?> 
