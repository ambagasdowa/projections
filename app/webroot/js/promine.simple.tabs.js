
Event.observe(window, 'load', function(){
  initTabs('tabs');
});

function initTabs(tabs_menu){
  if($(tabs_menu)){
    // listen to some events to implement a tab menu behavior
    $$('#' + tabs_menu + ' span').each(function(elem){
      elem.observe('click', function(){
        var blockName = "";
        var auxArray = [];
        $$('#' + tabs_menu + ' span').each(function(tab){
          // get the corresponding block name according to the tab id
          auxArray = tab.readAttribute("id").split("_");
          auxArray.pop();
          blockName = (auxArray.size() > 1) ? auxArray.join("_") : auxArray[0];
          blockName += "_content";
          
          if(tab == elem){
            tab.addClassName("selected");    
            $(blockName).show();
          }else{
            tab.removeClassName("selected");
            $(blockName).hide();
          }
        }, elem);
      })
    })
  }
}