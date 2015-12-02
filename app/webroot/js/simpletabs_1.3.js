/**
 * @version		1.3
 * @package		SimpleTabs
 * @author    Fotis Evangelou - http://nuevvo.com/labs/simpletabs
 * @copyright	Copyright (c) 2009-2011 Fotis Evangelou / Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// Main SimpleTabs function
var kmrSimpleTab = {

	sbContainerClass: "simpleTabss",
	sbNavClass: "simpleTabsNavigations",
	sbContentClass: "simpleTabsContents",
	sbCurrentNavClass: "current",
	sbCurrentTabClass: "currentTabs",
	sbIdPrefix: "tabber",

	init: function(){
		if(!document.getElementsByTagName) return false;
		if(!document.getElementById) return false;
		
		var containerDiv = document.getElementsByTagName("div");
	
		for(var i=0; i<containerDiv.length; i++){
			if (containerDiv[i].className == kmrSimpleTab.sbContainerClass) {
				
				// assign a unique ID for this tab block and then grab it
				containerDiv[i].setAttribute("id",kmrSimpleTab.sbIdPrefix+[i]);		
				var containerDivId = containerDiv[i].getAttribute("id");
	
				// Navigation
				var ul = containerDiv[i].getElementsByTagName("ul");
				
				for(var j=0; j<ul.length; j++){
					if (ul[j].className == kmrSimpleTab.sbNavClass) {
	
						var a = ul[j].getElementsByTagName("a");
						for(var k=0; k<a.length; k++){
							a[k].setAttribute("id",containerDivId+"_a_"+k);
							// get current
							if(kmrSimpleTab.readCookie('simpleTabsCookie')){
								var cookieElements = kmrSimpleTab.readCookie('simpleTabsCookie').split("_");
								var curTabCont = cookieElements[1];
								var curAnchor = cookieElements[2];
								if(a[k].parentNode.parentNode.parentNode.getAttribute("id")==kmrSimpleTab.sbIdPrefix+curTabCont){
									if(a[k].getAttribute("id")==kmrSimpleTab.sbIdPrefix+curTabCont+"_a_"+curAnchor){
										a[k].className = kmrSimpleTab.sbCurrentNavClass;
									} else {
										a[k].className = "";
									}
								} else {
									a[0].className = kmrSimpleTab.sbCurrentNavClass;
								}
							} else {
								a[0].className = kmrSimpleTab.sbCurrentNavClass;
							}
							
							a[k].onclick = function(){
								kmrSimpleTab.setCurrent(this,'simpleTabsCookie');
								return false;
							}
						}
					}
				}
	
				// Tab Content
				var div = containerDiv[i].getElementsByTagName("div");
				var countDivs = 0;
				for(var l=0; l<div.length; l++){
					if (div[l].className == kmrSimpleTab.sbContentClass) {
						div[l].setAttribute("id",containerDivId+"_div_"+[countDivs]);	
						if(kmrSimpleTab.readCookie('simpleTabsCookie')){
							var cookieElements = kmrSimpleTab.readCookie('simpleTabsCookie').split("_");
							var curTabCont = cookieElements[1];
							var curAnchor = cookieElements[2];		
							if(div[l].parentNode.getAttribute("id")==kmrSimpleTab.sbIdPrefix+curTabCont){
								if(div[l].getAttribute("id")==kmrSimpleTab.sbIdPrefix+curTabCont+"_div_"+curAnchor){
									div[l].className = kmrSimpleTab.sbContentClass+" "+kmrSimpleTab.sbCurrentTabClass;
								} else {
									div[l].className = kmrSimpleTab.sbContentClass;
								}
							} else {
								div[0].className = kmrSimpleTab.sbContentClass+" "+kmrSimpleTab.sbCurrentTabClass;
							}
						} else {
							div[0].className = kmrSimpleTab.sbContentClass+" "+kmrSimpleTab.sbCurrentTabClass;
						}
						countDivs++;
					}
				}	
	
				// End navigation and content block handling	
			}
		}
	},
	
	// Function to set the current tab
	setCurrent: function(elm,cookie){
		
		this.eraseCookie(cookie);
		
		//get container ID
		var thisContainerID = elm.parentNode.parentNode.parentNode.getAttribute("id");
	
		// get current anchor position
		var regExpAnchor = thisContainerID+"_a_";
		var thisLinkPosition = elm.getAttribute("id").replace(regExpAnchor,"");
	
		// change to clicked anchor
		var otherLinks = elm.parentNode.parentNode.getElementsByTagName("a");
		for(var n=0; n<otherLinks.length; n++){
			otherLinks[n].className = "";
		}
		elm.className = kmrSimpleTab.sbCurrentNavClass;
		
		// change to associated div
		var otherDivs = document.getElementById(thisContainerID).getElementsByTagName("div");
		var RegExpForContentClass = new RegExp(kmrSimpleTab.sbContentClass);
		for(var i=0; i<otherDivs.length; i++){
			if ( RegExpForContentClass.test(otherDivs[i].className) ) {
				otherDivs[i].className = kmrSimpleTab.sbContentClass;
			}
		}
		document.getElementById(thisContainerID+"_div_"+thisLinkPosition).className = kmrSimpleTab.sbContentClass+" "+kmrSimpleTab.sbCurrentTabClass;
	
		// get Tabs container ID
		var RegExpForPrefix = new RegExp(kmrSimpleTab.sbIdPrefix);
		var thisContainerPosition = thisContainerID.replace(RegExpForPrefix,"");
		
		// set cookie
		this.createCookie(cookie,'simpleTabsCookie_'+thisContainerPosition+'_'+thisLinkPosition,1);
	},
	
	// Cookies
	createCookie: function(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	},
	
	readCookie: function(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	},
	
	eraseCookie: function(name) {
		this.createCookie(name,"",-1);
	},

	// Loader
	addLoadEvent: function(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
			window.onload = func;
		} else {
			window.onload = function() {
				if (oldonload) {
					oldonload();
				}
				func();
			}
		}
	}
	
	// END
};

// Load SimpleTabs
kmrSimpleTab.addLoadEvent(kmrSimpleTab.init);
