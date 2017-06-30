!function(t,i,s,o,e){"use strict";var h=0,r=function(){var i,s=o.userAgent,e=/msie\s\d+/i;return s.search(e)>0&&(i=e.exec(s).toString(),i=i.split(" ")[1],9>i)?(t("html").addClass("lt-ie9"),!0):!1}();Function.prototype.bind||(Function.prototype.bind=function(t){var i=this,s=[].slice;if("function"!=typeof i)throw new TypeError;var o=s.call(arguments,1),e=function(){if(this instanceof e){var h=function(){};h.prototype=i.prototype;var r=new h,a=i.apply(r,o.concat(s.call(arguments)));return Object(a)===a?a:r}return i.apply(t,o.concat(s.call(arguments)))};return e}),Array.prototype.indexOf||(Array.prototype.indexOf=function(t,i){var s;if(null==this)throw new TypeError('"this" is null or not defined');var o=Object(this),e=o.length>>>0;if(0===e)return-1;var h=+i||0;if(Math.abs(h)===1/0&&(h=0),h>=e)return-1;for(s=Math.max(h>=0?h:e-Math.abs(h),0);e>s;){if(s in o&&o[s]===t)return s;s++}return-1});var a='<span class="irs"><span class="irs-line" tabindex="-1"><span class="irs-line-left"></span><span class="irs-line-mid"></span><span class="irs-line-right"></span></span><span class="irs-min">0</span><span class="irs-max">1</span><span class="irs-from">0</span><span class="irs-to">0</span><span class="irs-single">0</span></span><span class="irs-grid"></span><span class="irs-bar"></span>',n='<span class="irs-bar-edge"></span><span class="irs-shadow shadow-single"></span><span class="irs-slider single"></span>',c='<span class="irs-shadow shadow-from"></span><span class="irs-shadow shadow-to"></span><span class="irs-slider from"></span><span class="irs-slider to"></span>',l='<span class="irs-disable-mask"></span>',p=function(o,e,h){this.VERSION="2.0.13",this.input=o,this.plugin_count=h,this.current_plugin=0,this.calc_count=0,this.update_tm=0,this.old_from=0,this.old_to=0,this.raf_id=null,this.dragging=!1,this.force_redraw=!1,this.is_key=!1,this.is_update=!1,this.is_start=!0,this.is_finish=!1,this.is_active=!1,this.is_resize=!1,this.is_click=!1,this.$cache={win:t(s),body:t(i.body),input:t(o),cont:null,rs:null,min:null,max:null,from:null,to:null,single:null,bar:null,line:null,s_single:null,s_from:null,s_to:null,shad_single:null,shad_from:null,shad_to:null,edge:null,grid:null,grid_labels:[]};var r=this.$cache.input,a={type:r.data("type"),min:r.data("min"),max:r.data("max"),from:r.data("from"),to:r.data("to"),step:r.data("step"),min_interval:r.data("minInterval"),max_interval:r.data("maxInterval"),drag_interval:r.data("dragInterval"),values:r.data("values"),from_fixed:r.data("fromFixed"),from_min:r.data("fromMin"),from_max:r.data("fromMax"),from_shadow:r.data("fromShadow"),to_fixed:r.data("toFixed"),to_min:r.data("toMin"),to_max:r.data("toMax"),to_shadow:r.data("toShadow"),prettify_enabled:r.data("prettifyEnabled"),prettify_separator:r.data("prettifySeparator"),force_edges:r.data("forceEdges"),keyboard:r.data("keyboard"),keyboard_step:r.data("keyboardStep"),grid:r.data("grid"),grid_margin:r.data("gridMargin"),grid_num:r.data("gridNum"),grid_snap:r.data("gridSnap"),hide_min_max:r.data("hideMinMax"),hide_from_to:r.data("hideFromTo"),prefix:r.data("prefix"),postfix:r.data("postfix"),max_postfix:r.data("maxPostfix"),decorate_both:r.data("decorateBoth"),values_separator:r.data("valuesSeparator"),disable:r.data("disable")};a.values=a.values&&a.values.split(",");var n=r.prop("value");n&&(n=n.split(";"),n[0]&&n[0]==+n[0]&&(n[0]=+n[0]),n[1]&&n[1]==+n[1]&&(n[1]=+n[1]),e&&e.values&&e.values.length?(a.from=n[0]&&e.values.indexOf(n[0]),a.to=n[1]&&e.values.indexOf(n[1])):(a.from=n[0]&&+n[0],a.to=n[1]&&+n[1])),e=t.extend(a,e),this.options=t.extend({type:"single",min:10,max:100,from:null,to:null,step:1,min_interval:0,max_interval:0,drag_interval:!1,values:[],p_values:[],from_fixed:!1,from_min:null,from_max:null,from_shadow:!1,to_fixed:!1,to_min:null,to_max:null,to_shadow:!1,prettify_enabled:!0,prettify_separator:" ",prettify:null,force_edges:!1,keyboard:!1,keyboard_step:5,grid:!1,grid_margin:!0,grid_num:4,grid_snap:!1,hide_min_max:!1,hide_from_to:!1,prefix:"",postfix:"",max_postfix:"",decorate_both:!0,values_separator:" — ",disable:!1,onStart:null,onChange:null,onFinish:null,onUpdate:null},e),this.validate(),this.result={input:this.$cache.input,slider:null,min:this.options.min,max:this.options.max,from:this.options.from,from_percent:0,from_value:null,to:this.options.to,to_percent:0,to_value:null},this.coords={x_gap:0,x_pointer:0,w_rs:0,w_rs_old:0,w_handle:0,p_gap:0,p_gap_left:0,p_gap_right:0,p_step:0,p_pointer:0,p_handle:0,p_single:0,p_single_real:0,p_from:0,p_from_real:0,p_to:0,p_to_real:0,p_bar_x:0,p_bar_w:0,grid_gap:0,big_num:0,big:[],big_w:[],big_p:[],big_x:[]},this.labels={w_min:0,w_max:0,w_from:0,w_to:0,w_single:0,p_min:0,p_max:0,p_from:0,p_from_left:0,p_to:0,p_to_left:0,p_single:0,p_single_left:0},this.init()};p.prototype={init:function(t){this.coords.p_step=this.options.step/((this.options.max-this.options.min)/100),this.target="base",this.toggleInput(),this.append(),this.setMinMax(),t?(this.force_redraw=!0,this.calc(!0),this.callOnUpdate()):(this.force_redraw=!0,this.calc(!0),this.callOnStart()),this.updateScene()},append:function(){var t='<span class="irs js-irs-'+this.plugin_count+'"></span>';this.$cache.input.before(t),this.$cache.input.prop("readonly",!0),this.$cache.cont=this.$cache.input.prev(),this.result.slider=this.$cache.cont,this.$cache.cont.html(a),this.$cache.rs=this.$cache.cont.find(".irs"),this.$cache.min=this.$cache.cont.find(".irs-min"),this.$cache.max=this.$cache.cont.find(".irs-max"),this.$cache.from=this.$cache.cont.find(".irs-from"),this.$cache.to=this.$cache.cont.find(".irs-to"),this.$cache.single=this.$cache.cont.find(".irs-single"),this.$cache.bar=this.$cache.cont.find(".irs-bar"),this.$cache.line=this.$cache.cont.find(".irs-line"),this.$cache.grid=this.$cache.cont.find(".irs-grid"),"single"===this.options.type?(this.$cache.cont.append(n),this.$cache.edge=this.$cache.cont.find(".irs-bar-edge"),this.$cache.s_single=this.$cache.cont.find(".single"),this.$cache.from[0].style.visibility="hidden",this.$cache.to[0].style.visibility="hidden",this.$cache.shad_single=this.$cache.cont.find(".shadow-single")):(this.$cache.cont.append(c),this.$cache.s_from=this.$cache.cont.find(".from"),this.$cache.s_to=this.$cache.cont.find(".to"),this.$cache.shad_from=this.$cache.cont.find(".shadow-from"),this.$cache.shad_to=this.$cache.cont.find(".shadow-to"),this.setTopHandler()),this.options.hide_from_to&&(this.$cache.from[0].style.display="none",this.$cache.to[0].style.display="none",this.$cache.single[0].style.display="none"),this.appendGrid(),this.options.disable?(this.appendDisableMask(),this.$cache.input[0].disabled=!0):(this.$cache.cont.removeClass("irs-disabled"),this.$cache.input[0].disabled=!1,this.bindEvents())},setTopHandler:function(){var t=this.options.min,i=this.options.max,s=this.options.from,o=this.options.to;s>t&&o===i?this.$cache.s_from.addClass("type_last"):i>o&&this.$cache.s_to.addClass("type_last")},appendDisableMask:function(){this.$cache.cont.append(l),this.$cache.cont.addClass("irs-disabled")},remove:function(){this.$cache.cont.remove(),this.$cache.cont=null,this.$cache.line.off("keydown.irs_"+this.plugin_count),this.$cache.body.off("touchmove.irs_"+this.plugin_count),this.$cache.body.off("mousemove.irs_"+this.plugin_count),this.$cache.win.off("touchend.irs_"+this.plugin_count),this.$cache.win.off("mouseup.irs_"+this.plugin_count),r&&(this.$cache.body.off("mouseup.irs_"+this.plugin_count),this.$cache.body.off("mouseleave.irs_"+this.plugin_count)),this.$cache.grid_labels=[],this.coords.big=[],this.coords.big_w=[],this.coords.big_p=[],this.coords.big_x=[],cancelAnimationFrame(this.raf_id)},bindEvents:function(){this.$cache.body.on("touchmove.irs_"+this.plugin_count,this.pointerMove.bind(this)),this.$cache.body.on("mousemove.irs_"+this.plugin_count,this.pointerMove.bind(this)),this.$cache.win.on("touchend.irs_"+this.plugin_count,this.pointerUp.bind(this)),this.$cache.win.on("mouseup.irs_"+this.plugin_count,this.pointerUp.bind(this)),this.$cache.line.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.line.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.options.drag_interval&&"double"===this.options.type?(this.$cache.bar.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"both")),this.$cache.bar.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"both"))):(this.$cache.bar.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.bar.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"))),"single"===this.options.type?(this.$cache.single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.s_single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.shad_single.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.s_single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.edge.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_single.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"))):(this.$cache.single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.from.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.s_from.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.to.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.s_to.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.shad_from.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_to.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.from.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.s_from.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.to.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.s_to.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.shad_from.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_to.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"))),this.options.keyboard&&this.$cache.line.on("keydown.irs_"+this.plugin_count,this.key.bind(this,"keyboard")),r&&(this.$cache.body.on("mouseup.irs_"+this.plugin_count,this.pointerUp.bind(this)),this.$cache.body.on("mouseleave.irs_"+this.plugin_count,this.pointerUp.bind(this)))},pointerMove:function(t){if(this.dragging){var i=t.pageX||t.originalEvent.touches&&t.originalEvent.touches[0].pageX;this.coords.x_pointer=i-this.coords.x_gap,this.calc()}},pointerUp:function(i){this.current_plugin===this.plugin_count&&this.is_active&&(this.is_active=!1,(t.contains(this.$cache.cont[0],i.target)||this.dragging)&&(this.is_finish=!0,this.callOnFinish()),this.$cache.cont.find(".state_hover").removeClass("state_hover"),this.force_redraw=!0,this.dragging=!1,r&&t("*").prop("unselectable",!1),this.updateScene())},changeLevel:function(t){switch(t){case"single":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_single);break;case"from":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_from),this.$cache.s_from.addClass("state_hover"),this.$cache.s_from.addClass("type_last"),this.$cache.s_to.removeClass("type_last");break;case"to":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_to),this.$cache.s_to.addClass("state_hover"),this.$cache.s_to.addClass("type_last"),this.$cache.s_from.removeClass("type_last");break;case"both":this.coords.p_gap_left=this.toFixed(this.coords.p_pointer-this.coords.p_from),this.coords.p_gap_right=this.toFixed(this.coords.p_to-this.coords.p_pointer),this.$cache.s_to.removeClass("type_last"),this.$cache.s_from.removeClass("type_last")}},pointerDown:function(i,s){s.preventDefault();var o=s.pageX||s.originalEvent.touches&&s.originalEvent.touches[0].pageX;2!==s.button&&(this.current_plugin=this.plugin_count,this.target=i,this.is_active=!0,this.dragging=!0,this.coords.x_gap=this.$cache.rs.offset().left,this.coords.x_pointer=o-this.coords.x_gap,this.calcPointer(),this.changeLevel(i),r&&t("*").prop("unselectable",!0),this.$cache.line.trigger("focus"),this.updateScene())},pointerClick:function(t,i){i.preventDefault();var s=i.pageX||i.originalEvent.touches&&i.originalEvent.touches[0].pageX;2!==i.button&&(this.current_plugin=this.plugin_count,this.target=t,this.is_click=!0,this.coords.x_gap=this.$cache.rs.offset().left,this.coords.x_pointer=+(s-this.coords.x_gap).toFixed(),this.force_redraw=!0,this.calc(),this.$cache.line.trigger("focus"))},key:function(t,i){if(!(this.current_plugin!==this.plugin_count||i.altKey||i.ctrlKey||i.shiftKey||i.metaKey)){switch(i.which){case 83:case 65:case 40:case 37:i.preventDefault(),this.moveByKey(!1);break;case 87:case 68:case 38:case 39:i.preventDefault(),this.moveByKey(!0)}return!0}},moveByKey:function(t){var i=this.coords.p_pointer;t?i+=this.options.keyboard_step:i-=this.options.keyboard_step,this.coords.x_pointer=this.toFixed(this.coords.w_rs/100*i),this.is_key=!0,this.calc()},setMinMax:function(){if(this.options){if(this.options.hide_min_max)return this.$cache.min[0].style.display="none",void(this.$cache.max[0].style.display="none");this.options.values.length?(this.$cache.min.html(this.decorate(this.options.p_values[this.options.min])),this.$cache.max.html(this.decorate(this.options.p_values[this.options.max]))):(this.$cache.min.html(this.decorate(this._prettify(this.options.min),this.options.min)),this.$cache.max.html(this.decorate(this._prettify(this.options.max),this.options.max))),this.labels.w_min=this.$cache.min.outerWidth(!1),this.labels.w_max=this.$cache.max.outerWidth(!1)}},calc:function(t){if(this.options&&(this.calc_count++,(10===this.calc_count||t)&&(this.calc_count=0,this.coords.w_rs=this.$cache.rs.outerWidth(!1),"single"===this.options.type?this.coords.w_handle=this.$cache.s_single.outerWidth(!1):this.coords.w_handle=this.$cache.s_from.outerWidth(!1)),this.coords.w_rs)){this.calcPointer(),this.coords.p_handle=this.toFixed(this.coords.w_handle/this.coords.w_rs*100);var i=100-this.coords.p_handle,s=this.toFixed(this.coords.p_pointer-this.coords.p_gap);switch("click"===this.target&&(this.coords.p_gap=this.coords.p_handle/2,s=this.toFixed(this.coords.p_pointer-this.coords.p_gap),this.target=this.chooseHandle(s)),0>s?s=0:s>i&&(s=i),this.target){case"base":var o=(this.options.max-this.options.min)/100,e=(this.result.from-this.options.min)/o,h=(this.result.to-this.options.min)/o;this.coords.p_single_real=this.toFixed(e),this.coords.p_from_real=this.toFixed(e),this.coords.p_to_real=this.toFixed(h),this.coords.p_single_real=this.checkDiapason(this.coords.p_single_real,this.options.from_min,this.options.from_max),this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max),this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max),this.coords.p_single=this.toFixed(e-this.coords.p_handle/100*e),this.coords.p_from=this.toFixed(e-this.coords.p_handle/100*e),this.coords.p_to=this.toFixed(h-this.coords.p_handle/100*h),this.target=null;break;case"single":if(this.options.from_fixed)break;this.coords.p_single_real=this.calcWithStep(s/i*100),this.coords.p_single_real=this.checkDiapason(this.coords.p_single_real,this.options.from_min,this.options.from_max),this.coords.p_single=this.toFixed(this.coords.p_single_real/100*i);break;case"from":if(this.options.from_fixed)break;this.coords.p_from_real=this.calcWithStep(s/i*100),this.coords.p_from_real>this.coords.p_to_real&&(this.coords.p_from_real=this.coords.p_to_real),this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max),this.coords.p_from_real=this.checkMinInterval(this.coords.p_from_real,this.coords.p_to_real,"from"),this.coords.p_from_real=this.checkMaxInterval(this.coords.p_from_real,this.coords.p_to_real,"from"),this.coords.p_from=this.toFixed(this.coords.p_from_real/100*i);break;case"to":if(this.options.to_fixed)break;this.coords.p_to_real=this.calcWithStep(s/i*100),this.coords.p_to_real<this.coords.p_from_real&&(this.coords.p_to_real=this.coords.p_from_real),this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max),this.coords.p_to_real=this.checkMinInterval(this.coords.p_to_real,this.coords.p_from_real,"to"),this.coords.p_to_real=this.checkMaxInterval(this.coords.p_to_real,this.coords.p_from_real,"to"),this.coords.p_to=this.toFixed(this.coords.p_to_real/100*i);break;case"both":if(this.options.from_fixed||this.options.to_fixed)break;s=this.toFixed(s+.1*this.coords.p_handle),this.coords.p_from_real=this.calcWithStep((s-this.coords.p_gap_left)/i*100),this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max),this.coords.p_from_real=this.checkMinInterval(this.coords.p_from_real,this.coords.p_to_real,"from"),this.coords.p_from=this.toFixed(this.coords.p_from_real/100*i),this.coords.p_to_real=this.calcWithStep((s+this.coords.p_gap_right)/i*100),this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max),this.coords.p_to_real=this.checkMinInterval(this.coords.p_to_real,this.coords.p_from_real,"to"),this.coords.p_to=this.toFixed(this.coords.p_to_real/100*i)}"single"===this.options.type?(this.coords.p_bar_x=this.coords.p_handle/2,this.coords.p_bar_w=this.coords.p_single,this.result.from_percent=this.coords.p_single_real,this.result.from=this.calcReal(this.coords.p_single_real),this.options.values.length&&(this.result.from_value=this.options.values[this.result.from])):(this.coords.p_bar_x=this.toFixed(this.coords.p_from+this.coords.p_handle/2),this.coords.p_bar_w=this.toFixed(this.coords.p_to-this.coords.p_from),this.result.from_percent=this.coords.p_from_real,this.result.from=this.calcReal(this.coords.p_from_real),this.result.to_percent=this.coords.p_to_real,this.result.to=this.calcReal(this.coords.p_to_real),this.options.values.length&&(this.result.from_value=this.options.values[this.result.from],this.result.to_value=this.options.values[this.result.to])),this.calcMinMax(),this.calcLabels()}},calcPointer:function(){return this.coords.w_rs?(this.coords.x_pointer<0||isNaN(this.coords.x_pointer)?this.coords.x_pointer=0:this.coords.x_pointer>this.coords.w_rs&&(this.coords.x_pointer=this.coords.w_rs),void(this.coords.p_pointer=this.toFixed(this.coords.x_pointer/this.coords.w_rs*100))):void(this.coords.p_pointer=0)},chooseHandle:function(t){if("single"===this.options.type)return"single";var i=this.coords.p_from_real+(this.coords.p_to_real-this.coords.p_from_real)/2;return t>=i?this.options.to_fixed?"from":"to":this.options.from_fixed?"to":"from"},calcMinMax:function(){this.coords.w_rs&&(this.labels.p_min=this.labels.w_min/this.coords.w_rs*100,this.labels.p_max=this.labels.w_max/this.coords.w_rs*100)},calcLabels:function(){this.coords.w_rs&&!this.options.hide_from_to&&("single"===this.options.type?(this.labels.w_single=this.$cache.single.outerWidth(!1),this.labels.p_single=this.labels.w_single/this.coords.w_rs*100,this.labels.p_single_left=this.coords.p_single+this.coords.p_handle/2-this.labels.p_single/2,this.labels.p_single_left=this.checkEdges(this.labels.p_single_left,this.labels.p_single)):(this.labels.w_from=this.$cache.from.outerWidth(!1),this.labels.p_from=this.labels.w_from/this.coords.w_rs*100,this.labels.p_from_left=this.coords.p_from+this.coords.p_handle/2-this.labels.p_from/2,this.labels.p_from_left=this.toFixed(this.labels.p_from_left),this.labels.p_from_left=this.checkEdges(this.labels.p_from_left,this.labels.p_from),this.labels.w_to=this.$cache.to.outerWidth(!1),this.labels.p_to=this.labels.w_to/this.coords.w_rs*100,this.labels.p_to_left=this.coords.p_to+this.coords.p_handle/2-this.labels.p_to/2,this.labels.p_to_left=this.toFixed(this.labels.p_to_left),this.labels.p_to_left=this.checkEdges(this.labels.p_to_left,this.labels.p_to),this.labels.w_single=this.$cache.single.outerWidth(!1),this.labels.p_single=this.labels.w_single/this.coords.w_rs*100,this.labels.p_single_left=(this.labels.p_from_left+this.labels.p_to_left+this.labels.p_to)/2-this.labels.p_single/2,this.labels.p_single_left=this.toFixed(this.labels.p_single_left),this.labels.p_single_left=this.checkEdges(this.labels.p_single_left,this.labels.p_single)))},updateScene:function(){this.raf_id&&(cancelAnimationFrame(this.raf_id),this.raf_id=null),clearTimeout(this.update_tm),this.update_tm=null,this.options&&(this.drawHandles(),this.is_active?this.raf_id=requestAnimationFrame(this.updateScene.bind(this)):this.update_tm=setTimeout(this.updateScene.bind(this),300))},drawHandles:function(){this.coords.w_rs=this.$cache.rs.outerWidth(!1),this.coords.w_rs&&(this.coords.w_rs!==this.coords.w_rs_old&&(this.target="base",this.is_resize=!0),(this.coords.w_rs!==this.coords.w_rs_old||this.force_redraw)&&(this.setMinMax(),this.calc(!0),this.drawLabels(),this.options.grid&&(this.calcGridMargin(),this.calcGridLabels()),this.force_redraw=!0,this.coords.w_rs_old=this.coords.w_rs,this.drawShadow()),this.coords.w_rs&&(this.dragging||this.force_redraw||this.is_key)&&((this.old_from!==this.result.from||this.old_to!==this.result.to||this.force_redraw||this.is_key)&&(this.drawLabels(),this.$cache.bar[0].style.left=this.coords.p_bar_x+"%",this.$cache.bar[0].style.width=this.coords.p_bar_w+"%","single"===this.options.type?(this.$cache.s_single[0].style.left=this.coords.p_single+"%",this.$cache.single[0].style.left=this.labels.p_single_left+"%",this.options.values.length?(this.$cache.input.prop("value",this.result.from_value),this.$cache.input.data("from",this.result.from_value)):(this.$cache.input.prop("value",this.result.from),this.$cache.input.data("from",this.result.from))):(this.$cache.s_from[0].style.left=this.coords.p_from+"%",this.$cache.s_to[0].style.left=this.coords.p_to+"%",(this.old_from!==this.result.from||this.force_redraw)&&(this.$cache.from[0].style.left=this.labels.p_from_left+"%"),(this.old_to!==this.result.to||this.force_redraw)&&(this.$cache.to[0].style.left=this.labels.p_to_left+"%"),this.$cache.single[0].style.left=this.labels.p_single_left+"%",this.options.values.length?(this.$cache.input.prop("value",this.result.from_value+";"+this.result.to_value),this.$cache.input.data("from",this.result.from_value),this.$cache.input.data("to",this.result.to_value)):(this.$cache.input.prop("value",this.result.from+";"+this.result.to),this.$cache.input.data("from",this.result.from),this.$cache.input.data("to",this.result.to))),this.old_from===this.result.from&&this.old_to===this.result.to||this.is_start||this.$cache.input.trigger("change"),this.old_from=this.result.from,this.old_to=this.result.to,this.is_resize||this.is_update||this.is_start||this.is_finish||this.callOnChange(),(this.is_key||this.is_click)&&this.callOnFinish(),this.is_update=!1,this.is_resize=!1,this.is_finish=!1),this.is_start=!1,this.is_key=!1,this.is_click=!1,this.force_redraw=!1))},callOnStart:function(){this.options.onStart&&"function"==typeof this.options.onStart&&this.options.onStart(this.result)},callOnChange:function(){this.options.onChange&&"function"==typeof this.options.onChange&&this.options.onChange(this.result)},callOnFinish:function(){this.options.onFinish&&"function"==typeof this.options.onFinish&&this.options.onFinish(this.result)},callOnUpdate:function(){this.options.onUpdate&&"function"==typeof this.options.onUpdate&&this.options.onUpdate(this.result)},drawLabels:function(){if(this.options){var t,i,s,o=this.options.values.length,e=this.options.p_values;if(!this.options.hide_from_to)if("single"===this.options.type)o?(t=this.decorate(e[this.result.from]),this.$cache.single.html(t)):(t=this.decorate(this._prettify(this.result.from),this.result.from),this.$cache.single.html(t)),this.calcLabels(),this.labels.p_single_left<this.labels.p_min+1?this.$cache.min[0].style.visibility="hidden":this.$cache.min[0].style.visibility="visible",this.labels.p_single_left+this.labels.p_single>100-this.labels.p_max-1?this.$cache.max[0].style.visibility="hidden":this.$cache.max[0].style.visibility="visible";else{o?(this.options.decorate_both?(t=this.decorate(e[this.result.from]),t+=this.options.values_separator,t+=this.decorate(e[this.result.to])):t=this.decorate(e[this.result.from]+this.options.values_separator+e[this.result.to]),i=this.decorate(e[this.result.from]),s=this.decorate(e[this.result.to]),this.$cache.single.html(t),this.$cache.from.html(i),this.$cache.to.html(s)):(this.options.decorate_both?(t=this.decorate(this._prettify(this.result.from),this.result.from),t+=this.options.values_separator,t+=this.decorate(this._prettify(this.result.to),this.result.to)):t=this.decorate(this._prettify(this.result.from)+this.options.values_separator+this._prettify(this.result.to),this.result.to),i=this.decorate(this._prettify(this.result.from),this.result.from),s=this.decorate(this._prettify(this.result.to),this.result.to),this.$cache.single.html(t),this.$cache.from.html(i),this.$cache.to.html(s)),this.calcLabels();var h=Math.min(this.labels.p_single_left,this.labels.p_from_left),r=this.labels.p_single_left+this.labels.p_single,a=this.labels.p_to_left+this.labels.p_to,n=Math.max(r,a);this.labels.p_from_left+this.labels.p_from>=this.labels.p_to_left?(this.$cache.from[0].style.visibility="hidden",this.$cache.to[0].style.visibility="hidden",this.$cache.single[0].style.visibility="visible",this.result.from===this.result.to?(this.$cache.from[0].style.visibility="visible",this.$cache.single[0].style.visibility="hidden",n=a):(this.$cache.from[0].style.visibility="hidden",this.$cache.single[0].style.visibility="visible",n=Math.max(r,a))):(this.$cache.from[0].style.visibility="visible",this.$cache.to[0].style.visibility="visible",this.$cache.single[0].style.visibility="hidden"),h<this.labels.p_min+1?this.$cache.min[0].style.visibility="hidden":this.$cache.min[0].style.visibility="visible",n>100-this.labels.p_max-1?this.$cache.max[0].style.visibility="hidden":this.$cache.max[0].style.visibility="visible"}}},drawShadow:function(){var t,i,s,o,e=this.options,h=this.$cache,r="number"==typeof e.from_min&&!isNaN(e.from_min),a="number"==typeof e.from_max&&!isNaN(e.from_max),n="number"==typeof e.to_min&&!isNaN(e.to_min),c="number"==typeof e.to_max&&!isNaN(e.to_max);"single"===e.type?e.from_shadow&&(r||a)?(t=this.calcPercent(r?e.from_min:e.min),i=this.calcPercent(a?e.from_max:e.max)-t,t=this.toFixed(t-this.coords.p_handle/100*t),i=this.toFixed(i-this.coords.p_handle/100*i),t+=this.coords.p_handle/2,h.shad_single[0].style.display="block",h.shad_single[0].style.left=t+"%",h.shad_single[0].style.width=i+"%"):h.shad_single[0].style.display="none":(e.from_shadow&&(r||a)?(t=this.calcPercent(r?e.from_min:e.min),i=this.calcPercent(a?e.from_max:e.max)-t,t=this.toFixed(t-this.coords.p_handle/100*t),i=this.toFixed(i-this.coords.p_handle/100*i),t+=this.coords.p_handle/2,h.shad_from[0].style.display="block",h.shad_from[0].style.left=t+"%",h.shad_from[0].style.width=i+"%"):h.shad_from[0].style.display="none",e.to_shadow&&(n||c)?(s=this.calcPercent(n?e.to_min:e.min),o=this.calcPercent(c?e.to_max:e.max)-s,s=this.toFixed(s-this.coords.p_handle/100*s),o=this.toFixed(o-this.coords.p_handle/100*o),s+=this.coords.p_handle/2,h.shad_to[0].style.display="block",h.shad_to[0].style.left=s+"%",h.shad_to[0].style.width=o+"%"):h.shad_to[0].style.display="none")},toggleInput:function(){this.$cache.input.toggleClass("irs-hidden-input")},calcPercent:function(t){var i=(this.options.max-this.options.min)/100,s=(t-this.options.min)/i;return this.toFixed(s)},calcReal:function(t){var i,s,o=this.options.min,e=this.options.max,h=o.toString().split(".")[1],r=e.toString().split(".")[1],a=0,n=0;if(0===t)return this.options.min;if(100===t)return this.options.max;h&&(i=h.length,a=i),r&&(s=r.length,a=s),i&&s&&(a=i>=s?i:s),0>o&&(n=Math.abs(o),o=+(o+n).toFixed(a),e=+(e+n).toFixed(a));var c,l=(e-o)/100*t+o,p=this.options.step.toString().split(".")[1];return p?l=+l.toFixed(p.length):(l/=this.options.step,l*=this.options.step,l=+l.toFixed(0)),n&&(l-=n),c=p?+l.toFixed(p.length):this.toFixed(l),c<this.options.min?c=this.options.min:c>this.options.max&&(c=this.options.max),c},calcWithStep:function(t){var i=Math.round(t/this.coords.p_step)*this.coords.p_step;return i>100&&(i=100),100===t&&(i=100),this.toFixed(i)},checkMinInterval:function(t,i,s){var o,e,h=this.options;return h.min_interval?(o=this.calcReal(t),e=this.calcReal(i),"from"===s?e-o<h.min_interval&&(o=e-h.min_interval):o-e<h.min_interval&&(o=e+h.min_interval),this.calcPercent(o)):t},checkMaxInterval:function(t,i,s){var o,e,h=this.options;return h.max_interval?(o=this.calcReal(t),e=this.calcReal(i),"from"===s?e-o>h.max_interval&&(o=e-h.max_interval):o-e>h.max_interval&&(o=e+h.max_interval),this.calcPercent(o)):t},checkDiapason:function(t,i,s){var o=this.calcReal(t),e=this.options;return"number"!=typeof i&&(i=e.min),"number"!=typeof s&&(s=e.max),i>o&&(o=i),o>s&&(o=s),this.calcPercent(o)},toFixed:function(t){return t=t.toFixed(9),+t},_prettify:function(t){return this.options.prettify_enabled?this.options.prettify&&"function"==typeof this.options.prettify?this.options.prettify(t):this.prettify(t):t},prettify:function(t){var i=t.toString();return i.replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g,"$1"+this.options.prettify_separator)},checkEdges:function(t,i){return this.options.force_edges?(0>t?t=0:t>100-i&&(t=100-i),this.toFixed(t)):this.toFixed(t)},validate:function(){var t,i,s=this.options,o=this.result,e=s.values,h=e.length;if("string"==typeof s.min&&(s.min=+s.min),"string"==typeof s.max&&(s.max=+s.max),"string"==typeof s.from&&(s.from=+s.from),"string"==typeof s.to&&(s.to=+s.to),"string"==typeof s.step&&(s.step=+s.step),"string"==typeof s.from_min&&(s.from_min=+s.from_min),"string"==typeof s.from_max&&(s.from_max=+s.from_max),"string"==typeof s.to_min&&(s.to_min=+s.to_min),"string"==typeof s.to_max&&(s.to_max=+s.to_max),"string"==typeof s.keyboard_step&&(s.keyboard_step=+s.keyboard_step),"string"==typeof s.grid_num&&(s.grid_num=+s.grid_num),s.max<=s.min&&(s.min?s.max=2*s.min:s.max=s.min+1,s.step=1),h)for(s.p_values=[],s.min=0,s.max=h-1,s.step=1,s.grid_num=s.max,s.grid_snap=!0,i=0;h>i;i++)t=+e[i],isNaN(t)?t=e[i]:(e[i]=t,t=this._prettify(t)),s.p_values.push(t);("number"!=typeof s.from||isNaN(s.from))&&(s.from=s.min),("number"!=typeof s.to||isNaN(s.from))&&(s.to=s.max),"single"===s.type?(s.from<s.min&&(s.from=s.min),s.from>s.max&&(s.from=s.max)):((s.from<s.min||s.from>s.max)&&(s.from=s.min),(s.to>s.max||s.to<s.min)&&(s.to=s.max),s.from>s.to&&(s.from=s.to)),("number"!=typeof s.step||isNaN(s.step)||!s.step||s.step<0)&&(s.step=1),("number"!=typeof s.keyboard_step||isNaN(s.keyboard_step)||!s.keyboard_step||s.keyboard_step<0)&&(s.keyboard_step=5),"number"==typeof s.from_min&&s.from<s.from_min&&(s.from=s.from_min),"number"==typeof s.from_max&&s.from>s.from_max&&(s.from=s.from_max),"number"==typeof s.to_min&&s.to<s.to_min&&(s.to=s.to_min),"number"==typeof s.to_max&&s.from>s.to_max&&(s.to=s.to_max),o&&(o.min!==s.min&&(o.min=s.min),o.max!==s.max&&(o.max=s.max),(o.from<o.min||o.from>o.max)&&(o.from=s.from),(o.to<o.min||o.to>o.max)&&(o.to=s.to)),("number"!=typeof s.min_interval||isNaN(s.min_interval)||!s.min_interval||s.min_interval<0)&&(s.min_interval=0),("number"!=typeof s.max_interval||isNaN(s.max_interval)||!s.max_interval||s.max_interval<0)&&(s.max_interval=0),s.min_interval&&s.min_interval>s.max-s.min&&(s.min_interval=s.max-s.min),s.max_interval&&s.max_interval>s.max-s.min&&(s.max_interval=s.max-s.min);
},decorate:function(t,i){var s="",o=this.options;return o.prefix&&(s+=o.prefix),s+=t,o.max_postfix&&(o.values.length&&t===o.p_values[o.max]?(s+=o.max_postfix,o.postfix&&(s+=" ")):i===o.max&&(s+=o.max_postfix,o.postfix&&(s+=" "))),o.postfix&&(s+=o.postfix),s},updateFrom:function(){this.result.from=this.options.from,this.result.from_percent=this.calcPercent(this.result.from),this.options.values&&(this.result.from_value=this.options.values[this.result.from])},updateTo:function(){this.result.to=this.options.to,this.result.to_percent=this.calcPercent(this.result.to),this.options.values&&(this.result.to_value=this.options.values[this.result.to])},updateResult:function(){this.result.min=this.options.min,this.result.max=this.options.max,this.updateFrom(),this.updateTo()},appendGrid:function(){if(this.options.grid){var t,i,s,o,e,h=this.options,r=h.max-h.min,a=h.grid_num,n=0,c=0,l=4,p=0,_="";for(this.calcGridMargin(),h.grid_snap?(a=r/h.step,n=this.toFixed(h.step/(r/100))):n=this.toFixed(100/a),a>4&&(l=3),a>7&&(l=2),a>14&&(l=1),a>28&&(l=0),t=0;a+1>t;t++){for(s=l,c=this.toFixed(n*t),c>100&&(c=100,s-=2,0>s&&(s=0)),this.coords.big[t]=c,o=(c-n*(t-1))/(s+1),i=1;s>=i&&0!==c;i++)p=this.toFixed(c-o*i),_+='<span class="irs-grid-pol small" style="left: '+p+'%"></span>';_+='<span class="irs-grid-pol" style="left: '+c+'%"></span>',e=this.calcReal(c),e=h.values.length?h.p_values[e]:this._prettify(e),_+='<span class="irs-grid-text js-grid-text-'+t+'" style="left: '+c+'%">'+e+"</span>"}this.coords.big_num=Math.ceil(a+1),this.$cache.cont.addClass("irs-with-grid"),this.$cache.grid.html(_),this.cacheGridLabels()}},cacheGridLabels:function(){var t,i,s=this.coords.big_num;for(i=0;s>i;i++)t=this.$cache.grid.find(".js-grid-text-"+i),this.$cache.grid_labels.push(t);this.calcGridLabels()},calcGridLabels:function(){var t,i,s=[],o=[],e=this.coords.big_num;for(t=0;e>t;t++)this.coords.big_w[t]=this.$cache.grid_labels[t].outerWidth(!1),this.coords.big_p[t]=this.toFixed(this.coords.big_w[t]/this.coords.w_rs*100),this.coords.big_x[t]=this.toFixed(this.coords.big_p[t]/2),s[t]=this.toFixed(this.coords.big[t]-this.coords.big_x[t]),o[t]=this.toFixed(s[t]+this.coords.big_p[t]);for(this.options.force_edges&&(s[0]<-this.coords.grid_gap&&(s[0]=-this.coords.grid_gap,o[0]=this.toFixed(s[0]+this.coords.big_p[0]),this.coords.big_x[0]=this.coords.grid_gap),o[e-1]>100+this.coords.grid_gap&&(o[e-1]=100+this.coords.grid_gap,s[e-1]=this.toFixed(o[e-1]-this.coords.big_p[e-1]),this.coords.big_x[e-1]=this.toFixed(this.coords.big_p[e-1]-this.coords.grid_gap))),this.calcGridCollision(2,s,o),this.calcGridCollision(4,s,o),t=0;e>t;t++)i=this.$cache.grid_labels[t][0],i.style.marginLeft=-this.coords.big_x[t]+"%"},calcGridCollision:function(t,i,s){var o,e,h,r=this.coords.big_num;for(o=0;r>o&&(e=o+t/2,!(e>=r));o+=t)h=this.$cache.grid_labels[e][0],s[o]<=i[e]?h.style.visibility="visible":h.style.visibility="hidden"},calcGridMargin:function(){this.options.grid_margin&&(this.coords.w_rs=this.$cache.rs.outerWidth(!1),this.coords.w_rs&&("single"===this.options.type?this.coords.w_handle=this.$cache.s_single.outerWidth(!1):this.coords.w_handle=this.$cache.s_from.outerWidth(!1),this.coords.p_handle=this.toFixed(this.coords.w_handle/this.coords.w_rs*100),this.coords.grid_gap=this.toFixed(this.coords.p_handle/2-.1),this.$cache.grid[0].style.width=this.toFixed(100-this.coords.p_handle)+"%",this.$cache.grid[0].style.left=this.coords.grid_gap+"%"))},update:function(i){this.input&&(this.is_update=!0,this.options.from=this.result.from,this.options.to=this.result.to,this.options=t.extend(this.options,i),this.validate(),this.updateResult(i),this.toggleInput(),this.remove(),this.init(!0))},reset:function(){this.input&&(this.updateResult(),this.update())},destroy:function(){this.input&&(this.toggleInput(),this.$cache.input.prop("readonly",!1),t.data(this.input,"ionRangeSlider",null),this.remove(),this.input=null,this.options=null)}},t.fn.ionRangeSlider=function(i){return this.each(function(){t.data(this,"ionRangeSlider")||t.data(this,"ionRangeSlider",new p(this,i,h++))})},function(){for(var t=0,i=["ms","moz","webkit","o"],o=0;o<i.length&&!s.requestAnimationFrame;++o)s.requestAnimationFrame=s[i[o]+"RequestAnimationFrame"],s.cancelAnimationFrame=s[i[o]+"CancelAnimationFrame"]||s[i[o]+"CancelRequestAnimationFrame"];s.requestAnimationFrame||(s.requestAnimationFrame=function(i,o){var e=(new Date).getTime(),h=Math.max(0,16-(e-t)),r=s.setTimeout(function(){i(e+h)},h);return t=e+h,r}),s.cancelAnimationFrame||(s.cancelAnimationFrame=function(t){clearTimeout(t)})}()}(jQuery,document,window,navigator);