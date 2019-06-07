/**
 * Controls the behaviours of custom metabox fields.
 *
 * @author WebDevStudios
 * @see    https://github.com/WebDevStudios/CMB2
 */
/**
 * Custom jQuery for Custom Metaboxes and Fields
 */
window.CMB2=function(i,t,p,f){"use strict";
// localization strings
var s=i.cmb2_l10,d=i.setTimeout,u={formfield:"",idNumber:!1,file_frames:{},repeatEls:'input:not([type="button"]),select,textarea,.cmb2-media-status',styleBreakPoint:450,mediaHandlers:{},neweditor_id:[],defaults:{time_picker:s.defaults.time_picker,date_picker:s.defaults.date_picker,color_picker:s.defaults.color_picker||{}}},c=function(e){return p(t.getElementById(e))};return u.metabox=function(){return u.$metabox||(u.$metabox=p(".cmb2-wrap > .cmb2-metabox")),u.$metabox},u.init=function(){u.log("CMB2 localized data",s);var e=u.metabox(),t=e.find(".cmb-repeatable-group");
/**
		 * Initialize time/date/color pickers
		 */
u.initPickers(e.find('input[type="text"].cmb2-timepicker'),e.find('input[type="text"].cmb2-datepicker'),e.find('input[type="text"].cmb2-colorpicker')),
// Wrap date picker in class to narrow the scope of jQuery UI CSS and prevent conflicts
c("ui-datepicker-div").wrap('<div class="cmb2-element" />'),
// Insert toggle button into DOM wherever there is multicheck. credit: Genesis Framework
p('<p><span class="button cmb-multicheck-toggle">'+s.strings.check_toggle+"</span></p>").insertBefore(".cmb2-checkbox-list:not(.no-select-all)"),
// Make File List drag/drop sortable:
u.makeListSortable(),e.on("change",".cmb2_upload_file",function(){u.formfield=p(this).attr("id"),c(u.formfield+"_id").val("")}).on("click",".cmb-multicheck-toggle",u.toggleCheckBoxes).on("click",".cmb2-upload-button",u.handleMedia).on("click",".cmb-attach-list li, .cmb2-media-status .img-status img, .cmb2-media-status .file-status > span",u.handleFileClick).on("click",".cmb2-remove-file-button",u.handleRemoveMedia).on("click",".cmb-add-group-row",u.addGroupRow).on("click",".cmb-add-row-button",u.addAjaxRow).on("click",".cmb-remove-group-row",u.removeGroupRow).on("click",".cmb-remove-row-button",u.removeAjaxRow).on("keyup paste focusout",".cmb2-oembed",u.maybeOembed).on("cmb2_remove_row",".cmb-repeatable-group",u.resetTitlesAndIterator).on("click",".cmbhandle, .cmbhandle + .cmbhandle-title",u.toggleHandle),t.length&&t.filter(".sortable").each(function(){
// Add sorting arrows
p(this).find(".button.cmb-remove-group-row").before('<a class="button cmb-shift-rows move-up alignleft" href="#"><span class="'+s.up_arrow_class+'"></span></a> <a class="button cmb-shift-rows move-down alignleft" href="#"><span class="'+s.down_arrow_class+'"></span></a>')}).on("click",".cmb-shift-rows",u.shiftRows).on("cmb2_add_row",u.emptyValue),
// on pageload
d(u.resizeoEmbeds,500),
// and on window resize
p(i).on("resize",u.resizeoEmbeds)},u.resetTitlesAndIterator=function(){
// Loop repeatable group tables
p(".cmb-repeatable-group").each(function(){var i=p(this);
// Loop repeatable group table rows
i.find(".cmb-repeatable-grouping").each(function(e){var t=p(this);
// Reset rows iterator
t.data("iterator",e),
// Reset rows title
t.find(".cmb-group-title h4").text(i.find(".cmb-add-group-row").data("grouptitle").replace("{#}",e+1))})})},u.toggleHandle=function(e){e.preventDefault(),p(t).trigger("postbox-toggled",p(this).parent(".postbox").toggleClass("closed"))},u.toggleCheckBoxes=function(e){e.preventDefault();var t=p(this),i=t.closest(".cmb-td").find("input[type=checkbox]");
// If the button has already been clicked once...
t.data("checked")?(
// clear the checkboxes and remove the flag
i.prop("checked",!1),t.data("checked",!1)):(i.prop("checked",!0),t.data("checked",!0))},u.handleMedia=function(e){e.preventDefault();var t=p(this);u.attach_id=!t.hasClass("cmb2-upload-list")&&t.closest(".cmb-td").find(".cmb2-upload-file-id").val(),
// Clean up default 0 value
u.attach_id="0"!==u.attach_id&&u.attach_id,u._handleMedia(t.prev("input.cmb2-upload-file").attr("id"),t.hasClass("cmb2-upload-list"))},u.handleFileClick=function(e){e.preventDefault();var t=p(this),i=t.closest(".cmb-td"),a=i.find(".cmb2-upload-button").hasClass("cmb2-upload-list");u.attach_id=a?t.find('input[type="hidden"]').data("id"):i.find(".cmb2-upload-file-id").val(),u.attach_id&&u._handleMedia(i.find("input.cmb2-upload-file").attr("id"),a,u.attach_id)},u._handleMedia=function(e,i){if(wp){var t=u.metabox();u.formfield=e;var a=c(u.formfield),r=a.data("previewsize"),n=a.attr("name"),o=!0,l=!0;
// If this field's media frame already exists, reopen it.
u.formfield in u.file_frames||(
// Create the media frame.
u.file_frames[u.formfield]=wp.media({title:t.find("label[for="+u.formfield+"]").text(),button:{text:s.strings.upload_file},multiple:!!i}),u.mediaHandlers.list=function(e,t){
// Get all of our selected files
l=e.toJSON(),a.val(l.url),c(u.formfield+"_id").val(l.id);
// Setup our fileGroup array
var i=[];
// Loop through each attachment
if(p(l).each(function(){if(this.type&&"image"===this.type){var e=r[0]?r[0]:50,t=r[1]?r[1]:50;
// image preview
o='<li class="img-status"><img width="'+e+'" height="'+t+'" src="'+this.url+'" class="attachment-'+e+"px"+t+'px" alt="'+this.filename+'"><p><a href="#" class="cmb2-remove-file-button" rel="'+u.formfield+"["+this.id+']">'+s.strings.remove_image+'</a></p><input type="hidden" id="filelist-'+this.id+'" data-id="'+this.id+'" name="'+n+"["+this.id+']" value="'+this.url+'"></li>'}else
// Standard generic output if it's not an image.
o='<li class="file-status"><span>'+s.strings.file+" <strong>"+this.filename+'</strong></span>&nbsp;&nbsp; (<a href="'+this.url+'" target="_blank" rel="external">'+s.strings.download+'</a> / <a href="#" class="cmb2-remove-file-button" rel="'+u.formfield+"["+this.id+']">'+s.strings.remove_file+'</a>)<input type="hidden" id="filelist-'+this.id+'" data-id="'+this.id+'" name="'+n+"["+this.id+']" value="'+this.url+'"></li>';
// Add our file to our fileGroup array
i.push(o)}),t)return i;
// Append each item from our fileGroup array to .cmb2-media-status
p(i).each(function(){a.siblings(".cmb2-media-status").slideDown().append(this)})},u.mediaHandlers.single=function(e){if(
// Only get one file from the uploader
l=e.first().toJSON(),a.val(l.url),c(u.formfield+"_id").val(l.id),l.type&&"image"===l.type){
// image preview
var t=r[0]?r[0]:350;o='<div class="img-status"><img width="'+t+'px" style="max-width: '+t+'px; width: 100%; height: auto;" src="'+l.url+'" alt="'+l.filename+'" title="'+l.filename+'" /><p><a href="#" class="cmb2-remove-file-button" rel="'+u.formfield+'">'+s.strings.remove_image+"</a></p></div>"}else
// Standard generic output if it's not an image.
o='<div class="file-status"><span>'+s.strings.file+" <strong>"+l.filename+'</strong></span>&nbsp;&nbsp; (<a href="'+l.url+'" target="_blank" rel="external">'+s.strings.download+'</a> / <a href="#" class="cmb2-remove-file-button" rel="'+u.formfield+'">'+s.strings.remove_file+"</a>)</div>";
// add/display our output
a.siblings(".cmb2-media-status").slideDown().html(o)},u.mediaHandlers.selectFile=function(){var e=u.file_frames[u.formfield].state().get("selection"),t=i?"list":"single";u.attach_id&&i?p('[data-id="'+u.attach_id+'"]').parents("li").replaceWith(u.mediaHandlers.list(e,!0)):u.mediaHandlers[t](e)},u.mediaHandlers.openModal=function(){var e=u.file_frames[u.formfield].state().get("selection");if(!u.attach_id)return e.reset();var t=wp.media.attachment(u.attach_id);t.fetch(),e.set(t?[t]:[])},
// When a file is selected, run a callback.
u.file_frames[u.formfield].on("select",u.mediaHandlers.selectFile).on("open",u.mediaHandlers.openModal)),u.file_frames[u.formfield].open()}},u.handleRemoveMedia=function(e){e.preventDefault();var t=p(this);return t.is(".cmb-attach-list .cmb2-remove-file-button")?t.parents("li").remove():(u.formfield=t.attr("rel"),u.metabox().find("input#"+u.formfield).val(""),u.metabox().find("input#"+u.formfield+"_id").val(""),t.parents(".cmb2-media-status").html("")),!1},u.cleanRow=function(r,m,e){var t=r.find('input:not([type="button"]), select, textarea, label'),i=r.find("[id]").not('input:not([type="button"]), select, textarea, label');return e&&(
// Remove extra ajaxed rows
r.find(".cmb-repeat-table .cmb-repeat-row:not(:first-child)").remove(),
// Update all elements w/ an ID
i.length&&i.each(function(){var e=p(this),t=e.attr("id"),i=t.replace("_"+m,"_"+u.idNumber),a=r.find('[data-selector="'+t+'"]');e.attr("id",i),
// Replace data-selector vars
a.length&&a.attr("data-selector",i).data("selector",i)})),u.neweditor_id=[],t.filter(":checked").prop("checked",!1),t.filter(":selected").prop("selected",!1),r.find("h3.cmb-group-title").length&&r.find("h3.cmb-group-title").text(r.data("title").replace("{#}",u.idNumber+1)),t.each(function(){var e=p(this),t=e.hasClass("wp-editor-area"),i=e.attr("for"),a=e.attr("value"),r={},n,o;if(i)r={for:i.replace("_"+m,"_"+u.idNumber)};else{var l=e.attr("name"),s=l?l.replace("["+m+"]","["+u.idNumber+"]"):"";
// Replace 'name' attribute key
r={id:n=(o=e.attr("id"))?o.replace("_"+m,"_"+u.idNumber):"",name:s,
// value: '',
"data-iterator":u.idNumber}}
// Clear out old values
// wysiwyg field
if(f!==typeof a&&a&&(r.value=""),
// Clear out textarea values
"TEXTAREA"===e.prop("tagName")&&e.html(""),e.removeClass("hasDatepicker").attr(r).val(""),t){
// Get new wysiwyg ID
n=n?o.replace("zx"+m,"zx"+u.idNumber):"",
// Empty the contents
e.html("");
// Get wysiwyg field
var d=e.parents(".cmb-type-wysiwyg");
// Remove extra mce divs
d.find(".mce-tinymce:not(:first-child)").remove();
// Replace id instances
var c=d.html().replace(new RegExp(o,"g"),n);
// Update field html
d.html(c),
// Save ids for later to re-init tinymce
u.neweditor_id.push({id:n,old:o})}}),u},u.newRowHousekeeping=function(e){var t=e.find(".wp-picker-container"),i=e.find(".cmb2-media-status");return t.length&&
// Need to clean-up colorpicker before appending
t.each(function(){var e=p(this).parent();e.html(e.find('input[type="text"].cmb2-colorpicker').attr("style",""))}),
// Need to clean-up colorpicker before appending
i.length&&i.empty(),u},u.afterRowInsert=function(e){var t,i;
// Need to re-init wp_editor instances
if(u.neweditor_id.length)for(i=u.neweditor_id.length-1;0<=i;i--){var a=u.neweditor_id[i].id,r=u.neweditor_id[i].old;if(void 0===tinyMCEPreInit.mceInit[a]){var n=jQuery.extend({},tinyMCEPreInit.mceInit[r]);for(t in n)"string"==typeof n[t]&&(n[t]=n[t].replace(new RegExp(r,"g"),a));tinyMCEPreInit.mceInit[a]=n}if(void 0===tinyMCEPreInit.qtInit[a]){var o=jQuery.extend({},tinyMCEPreInit.qtInit[r]);for(t in o)"string"==typeof o[t]&&(o[t]=o[t].replace(new RegExp(r,"g"),a));tinyMCEPreInit.qtInit[a]=o}tinyMCE.init({id:tinyMCEPreInit.mceInit[a]})}
// Init pickers from new row
u.initPickers(e.find('input[type="text"].cmb2-timepicker'),e.find('input[type="text"].cmb2-datepicker'),e.find('input[type="text"].cmb2-colorpicker'))},u.updateNameAttr=function(){var e=p(this),t=e.attr("name");// get current name
// No name? bail
if(void 0===t)return!1;var i=parseInt(e.parents(".cmb-repeatable-grouping").data("iterator")),a=i-1,r=t.replace("["+i+"]","["+a+"]");
// New name with replaced iterator
e.attr("name",r)},u.emptyValue=function(e,t){p('input:not([type="button"]), textarea',t).val("")},u.addGroupRow=function(e){e.preventDefault();var t=p(this);
// before anything significant happens
t.trigger("cmb2_add_group_row_start",t);var i=c(t.data("selector")),a=i.find(".cmb-repeatable-grouping").last(),r=parseInt(a.data("iterator"));u.idNumber=r+1;var n=a.clone();u.newRowHousekeeping(n.data("title",t.data("grouptitle"))).cleanRow(n,r,!0),n.find(".cmb-add-row-button").prop("disabled",!1);var o=p('<div class="postbox cmb-row cmb-repeatable-grouping" data-iterator="'+u.idNumber+'">'+n.html()+"</div>");a.after(o),u.afterRowInsert(o),i.find(".cmb-repeatable-grouping").length<=1?i.find(".cmb-remove-group-row").prop("disabled",!0):i.find(".cmb-remove-group-row").prop("disabled",!1),i.trigger("cmb2_add_row",o)},u.addAjaxRow=function(e){e.preventDefault();var t=p(this),i=c(t.data("selector")),a=i.find(".empty-row"),r=parseInt(a.find("[data-iterator]").data("iterator"));u.idNumber=r+1;var n=a.clone();u.newRowHousekeeping(n).cleanRow(n,r),a.removeClass("empty-row hidden").addClass("cmb-repeat-row"),a.after(n),u.afterRowInsert(n),i.trigger("cmb2_add_row",n),i.find(".cmb-remove-row-button").removeClass("button-disabled")},u.removeGroupRow=function(e){e.preventDefault();var t=p(this),i=c(t.data("selector")),a=t.parents(".cmb-repeatable-grouping"),r=i.find(".cmb-repeatable-grouping").length;1<r&&(i.trigger("cmb2_remove_group_row_start",t),
// when a group is removed loop through all next groups and update fields names
a.nextAll(".cmb-repeatable-grouping").find(u.repeatEls).each(u.updateNameAttr),a.remove(),r<=2?i.find(".cmb-remove-group-row").prop("disabled",!0):i.find(".cmb-remove-group-row").prop("disabled",!1),i.trigger("cmb2_remove_row"))},u.removeAjaxRow=function(e){e.preventDefault();var t=p(this);
// Check if disabled
if(!t.hasClass("button-disabled")){var i=t.parents(".cmb-row"),a=t.parents(".cmb-repeat-table"),r=a.find(".cmb-row").length;2<r?(i.hasClass("empty-row")&&i.prev().addClass("empty-row").removeClass("cmb-repeat-row"),t.parents(".cmb-repeat-table .cmb-row").remove(),3===r&&a.find(".cmb-remove-row-button").addClass("button-disabled"),a.trigger("cmb2_remove_row")):t.addClass("button-disabled")}},u.shiftRows=function(e){e.preventDefault();var t=p(this);
// before anything signif happens
t.trigger("cmb2_shift_rows_enter",t);var i=t.parents(".cmb-repeatable-grouping"),a=t.hasClass("move-up")?i.prev(".cmb-repeatable-grouping"):i.next(".cmb-repeatable-grouping");if(a.length){
// we're gonna shift
t.trigger("cmb2_shift_rows_start",t);var r=[];
// Loop this items fields
i.find(u.repeatEls).each(function(){var e=p(this),t;
// special case for image previews
t=e.hasClass("cmb2-media-status")?e.html():"checkbox"===e.attr("type")||"radio"===e.attr("type")?e.is(":checked"):"select"===e.prop("tagName")?e.is(":selected"):e.val(),
// Get all the current values per element
r.push({val:t,$:e})}),
// And swap them all
a.find(u.repeatEls).each(function(e){var t=p(this),i;t.hasClass("cmb2-media-status")?(
// special case for image previews
i=t.html(),t.html(r[e].val),r[e].$.html(i)):"checkbox"===t.attr("type")||"radio"===t.attr("type")?(r[e].$.prop("checked",t.is(":checked")),t.prop("checked",r[e].val)):"select"===t.prop("tagName")?(r[e].$.prop("selected",t.is(":selected")),t.prop("selected",r[e].val)):(r[e].$.val(t.val()),t.val(r[e].val))}),
// shift done
t.trigger("cmb2_shift_rows_complete",t)}},u.initPickers=function(e,t,i){
// Initialize timepicker
u.initTimePickers(e),
// Initialize jQuery UI datepicker
u.initDatePickers(t),
// Initialize color picker
u.initColorPickers(i)},u.initTimePickers=function(e){e.length&&(e.timepicker("destroy"),e.timepicker(u.defaults.time_picker))},u.initDatePickers=function(e){e.length&&(e.datepicker("destroy"),e.datepicker(u.defaults.date_picker))},u.initColorPickers=function(e){e.length&&("object"==typeof jQuery.wp&&"function"==typeof jQuery.wp.wpColorPicker?e.wpColorPicker(u.defaults.color_picker):e.each(function(e){p(this).after('<div id="picker-'+e+'" style="z-index: 1000; background: #EEE; border: 1px solid #CCC; position: absolute; display: block;"></div>'),c("picker-"+e).hide().farbtastic(p(this))}).focus(function(){p(this).next().show()}).blur(function(){p(this).next().hide()}))},u.makeListSortable=function(){var e=u.metabox().find(".cmb2-media-status.cmb-attach-list");e.length&&e.sortable({cursor:"move"}).disableSelection()},u.maybeOembed=function(i){var t=p(this),e,a;({focusout:function(){d(function(){
// if it's been 2 seconds, hide our spinner
u.spinner(".postbox .cmb2-metabox",!0)},2e3)},keyup:function(){var e=function(e,t){return i.which<=t&&i.which>=e};
// Only Ajax on normal keystrokes
(e(48,90)||e(96,111)||e(8,9)||187===i.which||190===i.which)&&
// fire our ajax function
u.doAjax(t,i)},paste:function(){
// paste event is fired before the value is filled, so wait a bit
d(function(){u.doAjax(t)},100)}})[i.type]()},
/**
	 * Resize oEmbed videos to fit in their respective metaboxes
	 */
u.resizeoEmbeds=function(){u.metabox().each(function(){var e=p(this),t=e.parents(".inside"),i=e.parents(".inner-sidebar").length||e.parents("#side-sortables").length,n=i,a=!1;if(!t.length)return!0;// continue
// Calculate new width
var o=t.width();u.styleBreakPoint>o&&(n=!0,a=u.styleBreakPoint-62>o);var l=(o=n?o:Math.round(.82*t.width()*.97))-30;if(!n||i||a||(l-=75),639<l)return!0;// continue
var r,s=e.find(".cmb-type-oembed .embed-status").children().not(".cmb2-remove-wrapper");if(!s.length)return!0;// continue
s.each(function(){var e=p(this),t=e.width(),i=e.height(),a=l;e.parents(".cmb-repeat-row").length&&!n&&(
// Make room for our repeatable "remove" button column
a=l-91,a=o<785?a-15:a);
// Calc new height
var r=Math.round(a*i/t);e.width(a).height(r)})})},
/**
	 * Safely log things if query var is set
	 * @since  1.0.0
	 */
u.log=function(){s.script_debug&&console&&"function"==typeof console.log&&console.log.apply(console,arguments)},u.spinner=function(e,t){t?p(".cmb-spinner",e).hide():p(".cmb-spinner",e).show()},
// function for running our ajax
u.doAjax=function(e){
// get typed value
var t=e.val();
// only proceed if the field contains more than 6 characters
if(!(t.length<6)){
// get field id
var i=e.attr("id"),a=e.closest(".cmb-td"),r=a.find(".embed-status"),n=a.find(".embed_wrap"),o=r.find(":first-child"),l=r.length&&o.length?o.width():e.width();u.log("oembed_url",t,i),
// show our spinner
u.spinner(a),
// clear out previous results
n.html(""),
// and run our ajax function
d(function(){
// if they haven't typed in 500 ms
p(".cmb2-oembed:focus").val()===t&&p.ajax({type:"post",dataType:"json",url:s.ajaxurl,data:{action:"cmb2_oembed_handler",oembed_url:t,oembed_width:300<l?l:300,field_id:i,object_id:e.data("objectid"),object_type:e.data("objecttype"),cmb2_ajax_nonce:s.ajax_nonce},success:function(e){u.log(e),
// hide our spinner
u.spinner(a,!0),
// and populate our results from ajax response
n.html(e.data)}})},500)}},p(t).ready(u.init),u}(window,document,jQuery);