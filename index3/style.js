$(function(){d='';t={};r=1;lastNoti='';fnew=0;newPeople=0;b=[];ZoneOffsetMSeconds=3600000;timesetter.setTime(timesetter.getTime()+ZoneOffsetMSeconds);TimeNow="";clockID=0;$("#sideNav h2").click(function(){$(this).toggleClass('closed').parent().children("ul").toggle();});$("#msgs, #inbox").hover(function(){clearTimeout(t['inbox']);if(isTouchDevice())
{t['inbox']=setTimeout("closeMenu('inbox', 'msgs')",4000);}
$("#msgs").addClass('menuHover');$("#inbox").show();},function(){t['inbox']=setTimeout("closeMenu('inbox', 'msgs')",100);});$("#settings, #options").hover(function(){clearTimeout(t['settings']);if(isTouchDevice())
{t['settings']=setTimeout("closeMenu('options', 'settings')",4000);}
$("#settings").addClass('menuHover');$("#options").show();},function(){t['settings']=setTimeout("closeMenu('options', 'settings')",100);});$("#notis, #notifications").hover(function(){clearTimeout(t['notis']);if(isTouchDevice())
{t['notis']=setTimeout("closeMenu('notifications', 'notis')",4000);}
if($("#notifications li").hasClass('new'))
$("#notis").css("background-color","#333");$("#notis").addClass('menuHover');$("#notifications").show();},function(){t['notis']=setTimeout("closeMenu('notifications', 'notis')",100);});$("#friends, #people").hover(function(){clearTimeout(t['friends']);if(isTouchDevice())
{t['friends']=setTimeout("closeMenu('people', 'friends')",4000);}
if($("#people li").hasClass('new'))
$("#friends").css("background-color","#333");$("#friends").addClass('menuHover');$("#people").show();},function(){t['friends']=setTimeout("closeMenu('people', 'friends')",100);});$("#radio a").click(function(){popitup('../radio/',270,400,'no','radio');return false;});$("#notepad a").click(function(){popitup('../notepad.php',520,640);return false;});$("#mod li a[href='../mod/']").click(function(){popitup('../mod/',600,800,'no');return false;});resize();$(window).resize(function(){resize();});clock();$("#people .mention a").live('click',function(){$(this).parent().removeClass('new');newPeople--;$("#friends .num").text(newPeople);});$("[data-title]").tooltip({delay:0,showURL:false,track:true,bodyHandler:function(){return $(this).attr('data-title');}});$("#msgs").mousedown(function(){$(this).removeClass('on');$("#msgs .num").remove();d.msgcount=null;title();});if(isTouchDevice())
{$("#information ul").hide();$("#topNav a").click(function(){$("#mainFrame").css({zIndex:2});setTimeout('$("#mainFrame").css({ zIndex: 1 })',3000);});}
$.ajaxSetup({cache:false});initialJS();setInterval("updateData()",50000);$("#refresh").click(function(){$("#refresh").css({opacity:0});first(function(){$("#refresh").fadeTo('slow',1);});});$('a').focus(function(){$(this).attr("hideFocus","hidefocus");});document.body.onselectstart=function(){return false;}});function resize()
{iWidth=$("#main").width()- 140;iHeight=$("#main").height()- 80;$("#sideNav").height(iHeight- 39);if(iWidth<1120)
{$("html").addClass('small');iWidth+=25;}
else
$("html").removeClass('small');$("#main iframe").width(iWidth).height(iHeight).show();}
function closeMenu(menu,control)
{if(control=='notis')
{$.post('display.php',{noti:lastNoti});d.notisCount=null;title();$("#notis").css("background-color","");$("#notis").removeClass('on');$("#notis .num").remove();$("#notifications li").removeClass('new');$("#notifications").scrollTop(0);}
if(control=='friends')
{newPeople-=fnew;fnew=0;title();if(newPeople<=0)
{$("#friends").removeClass('on');$("#friends .num").remove();}
$("#friends").css("background-color","");$("#people .friend").removeClass('new');$("#people").scrollTop(0);}
$("#"+control).removeClass('menuHover');$("#"+menu).hide();}
function display(what,callback)
{$.getJSON('display.php?'+what,function(data){if(data.error)
error();else
d=data;callback();title();});}
function initialJS()
{display('initialJS',function(){msgs();notifications();people();});}
function first(callback)
{display('first',function(){msgs();stats();if(callback)
callback();});}
function second()
{display('second',function(){msgs();stats();notifications();});}
function third()
{display('third',function(){msgs();stats();$("#players li:first-child a").text(d.online+' Online');people();});}
function updateData()
{if((r%3)==0)
third();else if((r%2)==0)
second();else
first();r++;}
function msgs()
{if(d.msgcount)
{$("#msgs").addClass('on');if(d.msgcount>1)
{$("#msgs .num").remove();$("#msgs").prepend('<div class="num">'+d.msgcount+'</div>');}}
else
{$("#msgs").removeClass('on');$("#msgs .num").remove();}}
function stats()
{if(user!=d.user)
error();$("#rank a").text(d.rank);$("#health a").text(d.health);$("#gang a").text(d.gang);$("#cash a").text(d.money);$("#credits a").html(d.credits+'<span class="c">C</span>');$("#country a").text(d.country);$("#stats").removeClass('colours high med low');if(d.colour=='y')
$("#stats").addClass('colours '+d.hplevel);if(d.xp)
$("#rank").attr('data-title','Rank - '+d.xp+' XP');else
$("#rank").attr('data-title',"Rank - "+d.rankbar+"%<br /><div class='progress'><div class='width' style='width: "+d.rankbar+"%'></div></div>");}
function notifications()
{isNew='';if(d.notis)
{if(d.notisCount>1)
{$("#notis .num").remove();$("#notis").prepend('<div class="num">'+d.notisCount+'</div>');}
if(d.notisCount)
$("#notis").addClass('on');$("#notifications").empty();$.each(d.notis,function(i,item){if(item.isNew)
isNew=' class="new"';else
isNew='';$("#notifications").prepend('<li'+isNew+'>'+formatNoti(item.type,item.data)+'<time class="whenNoti">'+item.time+'</time></li>');lastNoti=i;});$("#notifications li").width($("#notifications").width());}}
function formatNoti(type,data)
{switch(type)
{case"2":return'<a href="../profile.php?user='+data+'" target="mainFrame">'+data+'</a> has been shot and killed.';break;case"3":return'<a href="../profile.php?user='+data+'" target="mainFrame">'+data+'</a> has reached Official GH Legend.';break;case"4":return'<a href="../profile.php?user='+data+'" target="mainFrame">'+data+'</a> has been hitlisted.';break;case"5":return'A new gang named <a href="../gangp.php?gang='+data+'" target="mainFrame">'+data+'</a> has been formed.';break;case"6":return'The gang named "'+data+'" has been destroyed.';break;case"7":parts=data.split("~");return'The  gang "'+parts[0]+'" has been renamed to <a href="../gangp.php?gang='+parts[1]+'" target="mainFrame">'+parts[1]+'</a>.';break;default:return data;}}
function people()
{mnew=0;peeps={};sortPeeps=[];online=null;isNew='';if(d.fnew)
fnew+=d.fnew;if(d.mnew)
mnew=d.mnew;if(fnew||mnew)
newPeople=fnew+ mnew;else
newPeople=0;if(newPeople>1)
{$("#friends .num").remove();$("#friends").prepend('<div class="num">'+newPeople+'</div>');}
if(newPeople)
$("#friends").addClass('on');$("#people").empty();if(d.friends)
{$.each(d.friends,function(i,item){if(item.isNew)
isNew=' class="new friend"';else
isNew='';if(item.foff)
online='was';else
online='is';peeps[item.funix+rand(9999)]='<li'+isNew+'><a href="../profile.php?user='+item.fuser+'" target="mainFrame">'+item.fuser+'</a> <em>('+item.fname+')</em> '+online+' logged on.<time class="whenNoti">'+item.ftime+'</time></li>';});}
if(d.mentions)
{$.each(d.mentions,function(i,item){if(item.seen)
isNew='';else
isNew=' class="new mention"';peeps[item.munix+rand(9999)]='<li'+isNew+'>'+formatMentions(item.mtype,item.muser,item.mdata)+'<time class="whenNoti">'+item.mtime+'</time></li>';});}
if(d.friends||d.mentions)
{for(k in peeps)
sortPeeps.push(k);sortPeeps.sort();$.each(sortPeeps,function(i,item){$("#people").prepend(peeps[item]);});}else
$("#people").prepend('<li>You can add friends by clicking this button.</li>');$("#people li").width($("#people").width());}
function formatMentions(type,user,data)
{switch(type)
{case"1":return'<a href="../profile.php?user='+user+'" target="mainFrame">'+user+'</a> has mentioned you on their profile.';break;case"2":return'<a href="../profile.php?user='+user+'" target="mainFrame">'+user+'</a> has updated their profile.';break;case"3":return'<a href="../profile.php?user='+user+'" target="mainFrame">'+user+'</a> spoke about you in a <a href="../posts.php?post='+data+'" target="mainFrame">forum thread</a>.';break;case"4":return'<a href="../profile.php?user='+user+'" target="mainFrame">'+user+'</a> spoke about you in a <a href="../posts.php?mention='+data+'" target="mainFrame">forum post</a>.';break;}}
function title()
{titlebit='';if(d.msgcount)
{titlebit='Inbox('+d.msgcount+')';if(d.notisCount||(newPeople>0))
titlebit+=' - ';}
if(d.notisCount||(newPeople>0))
{if(d.notisCount)
total=d.notisCount+ newPeople;else
total=newPeople;titlebit+='Alert('+total+')';}
titlebit=titlebit||user+' logged in';document.title=titlebit;}
function error()
{location.reload(true);}
function rand(n)
{return(Math.floor(Math.random()*n+1));}
function popitup(url,height,width,scrollbars,name){if(height==null)
height=590;if(width==null)
width=790;scrollbars=scrollbars||'yes';name=name||rand(9999);newwindow=window.open(url,'name'+name,'height='+height+',width='+width+',resizable=no,status=no,scrollbars='+scrollbars+',location=no');if(window.focus){newwindow.focus()}
return false;}
function clock()
{if(clockID){clearTimeout(clockID);clockID=0;}
var hhN=timesetter.getHours();if(hhN>12){var hh=String(hhN- 12);var AP="PM";}else if(hhN==12){var hh="12";var AP="PM";}else if(hhN==0){var hh="12";var AP="AM";}else{var hh=String(hhN);var AP="AM";}
var mm=String(timesetter.getMinutes());if(mm<10){mm="0"+mm;}
TimeNow=hh+":"+mm+" "+AP;$("#clock").text(TimeNow);clockID=setTimeout("clock();",20000);timesetter.setTime(timesetter.getTime()+20000);}
function isTouchDevice()
{var el=document.createElement('div');el.setAttribute('ongesturestart','return;');if(typeof el.ongesturestart=="function"){return true;}else{return false}};(function($){var helper={},current,title,tID,IE=$.browser.msie&&/MSIE\s(5\.5|6\.)/.test(navigator.userAgent),track=false;$.tooltip={blocked:false,defaults:{delay:200,fade:false,showURL:true,extraClass:"",top:15,left:15,id:"tooltip"},block:function(){$.tooltip.blocked=!$.tooltip.blocked;}};$.fn.extend({tooltip:function(settings){settings=$.extend({},$.tooltip.defaults,settings);createHelper(settings);return this.each(function(){$.data(this,"tooltip",settings);this.tOpacity=helper.parent.css("opacity");this.tooltipText=this.title;$(this).removeAttr("title");this.alt="";}).mouseover(save).mouseout(hide).click(hide);},fixPNG:IE?function(){return this.each(function(){var image=$(this).css('backgroundImage');if(image.match(/^url\(["']?(.*\.png)["']?\)$/i)){image=RegExp.$1;$(this).css({'backgroundImage':'none','filter':"progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=crop, src='"+image+"')"}).each(function(){var position=$(this).css('position');if(position!='absolute'&&position!='relative')$(this).css('position','relative');});}});}:function(){return this;},unfixPNG:IE?function(){return this.each(function(){$(this).css({'filter':'',backgroundImage:''});});}:function(){return this;},hideWhenEmpty:function(){return this.each(function(){$(this)[$(this).html()?"show":"hide"]();});},url:function(){return this.attr('href')||this.attr('src');}});function createHelper(settings){if(helper.parent)return;helper.parent=$('<div id="'+settings.id+'"><h3></h3><div class="body"></div><div class="url"></div></div>').appendTo(document.body).hide();if($.fn.bgiframe)helper.parent.bgiframe();helper.title=$('h3',helper.parent);helper.body=$('div.body',helper.parent);helper.url=$('div.url',helper.parent);}function settings(element){return $.data(element,"tooltip");}function handle(event){if(settings(this).delay)tID=setTimeout(show,settings(this).delay);else
show();track=!!settings(this).track;$(document.body).bind('mousemove',update);update(event);}function save(){if($.tooltip.blocked||this==current||(!this.tooltipText&&!settings(this).bodyHandler))return;current=this;title=this.tooltipText;if(settings(this).bodyHandler){helper.title.hide();var bodyContent=settings(this).bodyHandler.call(this);helper.body.html(bodyContent);helper.body.show();}else if(settings(this).showBody){var parts=title.split(settings(this).showBody);helper.title.html(parts.shift()).show();helper.body.empty();for(var i=0,part;(part=parts[i]);i++){if(i>0)helper.body.append("<br/>");helper.body.append(part);}helper.body.hideWhenEmpty();}else{helper.title.html(title).show();helper.body.hide();}if(settings(this).showURL&&$(this).url())helper.url.html($(this).url().replace('http://','')).show();else
helper.url.hide();helper.parent.addClass(settings(this).extraClass);if(settings(this).fixPNG)helper.parent.fixPNG();handle.apply(this,arguments);}function show(){tID=null;if((!IE||!$.fn.bgiframe)&&settings(current).fade){if(helper.parent.is(":animated"))helper.parent.stop().show().fadeTo(settings(current).fade,current.tOpacity);else
helper.parent.is(':visible')?helper.parent.fadeTo(settings(current).fade,current.tOpacity):helper.parent.fadeIn(settings(current).fade);}else{helper.parent.show();}update();}function update(event){if($.tooltip.blocked)return;if(event&&event.target.tagName=="OPTION"){return;}if(!track&&helper.parent.is(":visible")){$(document.body).unbind('mousemove',update)}if(current==null){$(document.body).unbind('mousemove',update);return;}helper.parent.removeClass("viewport-right").removeClass("viewport-bottom");var left=helper.parent[0].offsetLeft;var top=helper.parent[0].offsetTop;if(event){left=event.pageX+settings(current).left;top=event.pageY+settings(current).top;var right='auto';if(settings(current).positionLeft){right=$(window).width()-left;left='auto';}helper.parent.css({left:left,right:right,top:top});}var v=viewport(),h=helper.parent[0];if(v.x+v.cx<h.offsetLeft+h.offsetWidth){left-=h.offsetWidth+20+settings(current).left;helper.parent.css({left:left+'px'}).addClass("viewport-right");}if(v.y+v.cy<h.offsetTop+h.offsetHeight){top-=h.offsetHeight+20+settings(current).top;helper.parent.css({top:top+'px'}).addClass("viewport-bottom");}}function viewport(){return{x:$(window).scrollLeft(),y:$(window).scrollTop(),cx:$(window).width(),cy:$(window).height()};}function hide(event){if($.tooltip.blocked)return;if(tID)clearTimeout(tID);current=null;var tsettings=settings(this);function complete(){helper.parent.removeClass(tsettings.extraClass).hide().css("opacity","");}if((!IE||!$.fn.bgiframe)&&tsettings.fade){if(helper.parent.is(':animated'))helper.parent.stop().fadeTo(tsettings.fade,0,complete);else
helper.parent.stop().fadeOut(tsettings.fade,complete);}else
complete();if(settings(this).fixPNG)helper.parent.unfixPNG();}})(jQuery);