!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)}(function(t){var e={isInitDone:!1};e.listTemplate='<div class="jquery-todolist ui-widget" style="display:none;">\n    <div class="jquery-todolist-title ui-widget-header">\n        <div class="jquery-todolist-action-edit jquery-todolist-action">\n            <span class="jquery-todolist-title-text"></span>\n        </div>\n        <span class="jquery-todolist-menu-show jquery-todolist-action ui-widget-header">...</span>\n    </div>\n\n    <div class="jquery-todolist-items"></div>\n\n    <div class="jquery-todolist-footer ui-widget-content">\n        <div class="jquery-todolist-add ui-state-default">\n            <span class="jquery-todolist-add-input ui-widget-content">\n                <input class="jquery-todolist-add-input-text" placeholder="New Item" type="text" name="j" name="j" value="" />\n            </span>\n            <a class="jquery-todolist-action jquery-todolist-add-action" href="javascript:">+</a>\n        </div>\n    </div>\n</div>',e.itemTemplate='<div class="jquery-todolist-item">\n    <div class="ui-state-default">\n        <div class="jquery-todolist-item-title ui-widget-content jquery-todolist-action-edit jquery-todolist-action">\n            <span class="jquery-todolist-item-title-text"></span>\n        </div>\n    </div>\n    <span class="jquery-todolist-item-actions-left">\n        <span class="jquery-todolist-action jquery-todolist-item-checkbox">&#9744;</span>\n    </span>\n    <span class="jquery-todolist-item-actions-right">\n        <span class="jquery-todolist-action jquery-todolist-item-action-remove">&times;</span>\n    </span>\n</div>',e.itemEditTemplate='<div class="jquery-todolist-edit">\n    <div class="jquery-todolist-edit-input">\n        <input type="text" name="e" value="" />\n    </div>\n    <span class="jquery-todolist-edit-save" title="Save">Save</span>\n</div>',e.confirmButtonTemplate='<span class="jquery-todolist-button ui-state-default">\n    <span class="jquery-todolist-action jquery-todolist-button-confirm">continue?</span>\n    <span class="jquery-todolist-action jquery-todolist-button-cancel">&times;</span>\n</span>',e.menuTemplate='<div class="jquery-todolist-menu ui-widget-content">\n    <div class="jquery-todolist-menu-actions">\n        <a href="javascript:" class="jquery-todolist-action" data-todolistaction="close menu">&times</a>\n    </div>\n    <div class="jquery-todolist-menu-items">\n        <a href="javascript:" class="ui-state-default jquery-todolist-action jquery-todolist-menu-item" data-todolistaction="toggle done">Show/Hide Done</a>\n    </div>\n</div>\n',e.styles='.jquery-todolist{position:relative;min-width:15em}.jquery-todolist *,.jquery-todolist *:before,.jquery-todolist *:after{margin:0;padding:0;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.jquery-todolist .jquery-todolist-title{padding:.5em 2em .5em .5em;position:relative;max-height:5em;overflow:hidden}.jquery-todolist .jquery-todolist-title-text{display:inline-block;width:100%}.jquery-todolist .jquery-todolist-menu-show{display:block;position:absolute;right:-1px;top:-1px;font-weight:900;cursor:pointer;vertical-align:middle;font-size:.9em;height:6em;padding:.2em}.jquery-todolist .jquery-todolist-menu{position:absolute;top:0px;right:0px;width:10em;padding:.2em;z-index:1}.jquery-todolist .jquery-todolist-menu-actions{position:absolute;right:.2em;top:.2em}.jquery-todolist .jquery-todolist-menu-actions .jquery-todolist-action{padding:.2em;display:inline-block}.jquery-todolist .jquery-todolist-menu-items{max-height:10em;overflow-y:auto;margin:2em 0em 1em}.jquery-todolist .jquery-todolist-menu-items a{display:block;padding:.2em;margin-bottom:0.5em}.jquery-todolist .jquery-todolist-footer{position:relative}.jquery-todolist .jquery-todolist-action{cursor:pointer;text-decoration:none}.jquery-todolist .jquery-todolist-button{display:inline-block}.jquery-todolist .jquery-todolist-button-confirm{display:inline-block;padding:.2em;height:6em;border-top:none;border-bottom:none;border-right:none}.jquery-todolist .jquery-todolist-button-cancel{display:inline-block;padding:.2em;height:6em}.jquery-todolist .jquery-todolist-add{padding:1px 40px 1px 1px;position:relative;border:none}.jquery-todolist .jquery-todolist-add-input,.jquery-todolist .jquery-todolist-add-action{line-height:1.5em;display:inline-block}.jquery-todolist .jquery-todolist-add-input{width:100%;border:none}.jquery-todolist .jquery-todolist-add-input-text{width:100%;border:none;line-height:1.5em;padding:.5em}.jquery-todolist .jquery-todolist-add-action{display:inline-block;text-decoration:none;overflow:hidden;font-weight:900;padding:0em;text-align:center;font-size:2em;line-height:1.1em;position:absolute;width:40px;top:0px;right:0px}.jquery-todolist .jquery-todolist-edit{position:relative}.jquery-todolist .jquery-todolist-edit-input{width:100%;padding-right:40px}.jquery-todolist .jquery-todolist-edit-input input{width:100%;padding:.5em;line-height:1.5em}.jquery-todolist .jquery-todolist-edit-save{background-repeat:no-repeat;display:inline-block;text-indent:-1000px;overflow:hidden;position:absolute;right:12px;top:0px;width:25px;text-align:center;line-height:2em;cursor:pointer;background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAACCklEQVRIib2Wy27TQBSGR4pJvOA5YNtHmKUjjDQbC3EHpYAIK1iCmtSWmqob0rSOnfTOVULpS3ST90gXbEhbsDP2JI71s6B1cyc0Dr90dqPv05kz0hlCeqJpWpJSKs9SmqYlyWAopQuMsXpaUXxVVfkslVYUnzFWp5QuRALGWP2wVkMYhpg1YRjisFYDY6weXUtaUfw44L2StKL4mqYlCaVUVlWVx0Y/j6qqnFIqxyIQQuCd+RmF7W/RNccmEELgqWFD2nRw/f13vFmrotvtxiPwfR9PdAvSpgNSBUgFuGkc4bjRmF3geR4eL1uQzEu4tNFCRrchhBgtCIIAb81PeF08QKvVmgh/lC9DMt0euIuMbsPzPAAjZhAEAbIFC3K1icSuh3vLFlzXHYJzzvFwEF5ykNEt+L4fnRsSHDcauLF2BPIRIB+AxI6Hu/l+CeccD3JmH/xaycHiAHxsBy9XK0hVz0AOALIPJLY83Fky4TgOOOe4v2RCKrd64L+wqFsQQgx1OnIGnU4H2dUKUvYpyB5AdoFExcOt3D5u5/b64es/8WwMfKwgkhRspMwTkB2AbJ/XFiJ4cv0Mz43x8ImCPslG80rwvwqAP082u2JBLjUv4cVTvDDKaLfbE+FTCS4kr1YsyMUfSBVPpoZPLbiQGPZX5Mtfpob/k+CqiQRzXzhzX5n/ZenP89vyG9UicsE1jZqPAAAAAElFTkSuQmCC")}.jquery-todolist .jquery-todolist-item{margin:.3em 0em .3em;position:relative;overflow:hidden}.jquery-todolist .jquery-todolist-item-title{border-bottom:medium none;border-top:medium none;border-right:medium none;line-height:1.5em;padding:0.5em;margin-left:40px;padding-right:23px;max-height:6em;overflow:hidden}.jquery-todolist .jquery-todolist-item-title-text{display:inline-block;width:100%}.jquery-todolist .jquery-todolist-item-actions-left{display:inline-block;position:absolute;top:.5em;left:7px}.jquery-todolist .jquery-todolist-item-actions-right{display:inline-block;position:absolute;top:0px;right:0px;height:6em}.jquery-todolist .jquery-todolist-item-action-remove{background-repeat:no-repeat;display:inline-block;text-indent:-1000px;text-align:center;overflow:hidden;background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABA0lEQVQ4jY3Sz0oCYRQF8N+ssrdIJ1chopuQ3qBFuOjNLLJAEFwIvkUZBSW9Sq6qZYs7xuf4VR6YxXfPPefO/cMuehjjC0/V94EbdDP5PzjEBFOcZPgOZrhFIyd+w/lfFSpc4KVuMtlTvMFQtInoeZqQZygzojYGyXuumsnYds8lHmsmx1XsKIn1cE1Mu47UpMSyJoYCa2JNOWxMcuINXv8zWOIezV9yVvCZIdKem3hAq5ZT4J24sE5CtO0OrFX9TWrSx4hYxSwhBvI9lzhN3ou08J24sH1xias00BDnOdxT/IyDOtEQRzUXR1IkXCF6XlSVd8QpuuLC1mLPKzHtke1hg295iTKQEXiRlAAAAABJRU5ErkJggg==");position:absolute;right:5px;top:.5em;height:17px;width:17px;cursor:pointer}.jquery-todolist .jquery-todolist-item-action-remove-confirm{background-repeat:no-repeat;text-indent:-1000px;text-align:center;overflow:hidden;display:inline-block;padding:.2em;width:19px;height:24px;background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAYCAYAAAAYl8YPAAACTUlEQVQ4T62VS0iVURSFVRpYGCnlxKIGUdBLbRA9zGgmaYI0SKVhEWVENCjTgVGgUhhElBrmSAslGvlqJhg9iAbaAyVKpHQghqFYEkH2LTkH9v05XW/ggcVZe+91193/Oec/f3JS/JFCeZWR/IT/+ddPkuN4qTYCthrNG/ieeGYTFLOW6DCR8rj+fQqsS0S9hGZKZmkgdRnM5mWmRf4IVjhDLfB2MAxU/wV2gE+uPsu8G3w2DXxXzm/AV4INprgGrrVU1zJLB/OuLm0+GDP6d/Bsb/aKYK8pboS/BOsDZu/JnQBDRv8UfsSbPSE4Zoq74J1Ajxvt7Dm5KjBg9K3wU97sDsF5UzwIvwkOBMx6yDWDLqO/Dr/qzS4T3DDFo/Bzaj1g9ohcH2gz+tPwFm+mNWg3RcXFoCxg1kTuA7hr9EXwXm92mKDfFCvg2eBMwKye3ByoNfpc+JA320Kgs+ZHNUTHozJgdoXcWnDJ6DPh37yZboYfpqj1mwF1AbOz5HRotU4a2u2VYMHeGtMkMpxAu/UWNAbMysmVgFKnHWXeLG7NdIp3OkEHs7b+YcCskNwFUOC0z5gPRc10ir1AW38PdAfM8sjdAvvMH6vbmM4eEJ90ghfMWnz9a/QNUPePwTanbWBe3Az7mNeIa5xA50hnTI8eNdOF8Br4C/Ui/HbUTLtz35npxtgPvgTMVpObBP7bcNx1GtOZFlbvnYY+HFo/PeZvoCtHN8sC0DdA3wI/9P7qhokxyyEeNKJE6Sb3BDFmOtVaq/8Z6lR3n7pP+guXqYbxgVDCfwAAAABJRU5ErkJggg==")}.jquery-todolist .jquery-todolist-item-checkbox{background-repeat:no-repeat;display:inline-block;text-indent:-1000px;text-align:center;overflow:hidden;height:26px;width:26px;background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAAh0lEQVRIie3WsQ3DMAxEUY6gUT6OC2hDjeZRNILdhEYgpwlMu+IBbPUoNTozMwOapCFpuvueMZKmpAE0C8Tdtyzgx2xAM0nja4sBdLsZoK/nWjyXpHEXWBOYpGmhZtxkDUCcf0LZSKSgggoqqKCC/oEAshGgn9BrX/lD5YRLOXmtbn02eLxAHkhQNNgPmtd0AAAAAElFTkSuQmCC");opacity:.7;cursor:pointer}.jquery-todolist .jquery-todolist-item-done .jquery-todolist-item-checkbox{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAABIUlEQVRIib3WYZGDMBQE4CcBCZWws2sACUg4CZVwDiKlEpCAhEpAwt0fwnC59yCdpGWGP5DkS5aQxMzMAAwkE8lV0k+Pm+RKMgEYLCOSll6Acy8ABiOZDr1IAEZrvACMZbuW4yKZWoHyyhjJ1bLaOhIAIPm9f5PtWW5/hxqR4ZDMKmnK77pCkh7lJOgOSZqcmTZ3hY6RHf8fALeukBcZyXtRpg26iqwLVBNZFbQ19OefKCp7kX0FZX2oWPuWEiN5dyJ7RKMPIWeB3TEAtyAyd+SnEMlntAJLmp13U4RcRQdvXwr2qjCyS+gMeyWyKqgSO42sGrrALiN7CfIwks+ayEIIAM4wSfOGhOWceuMOfWwrf9PhBP8OJx87bm09ePsB8hfZBPJdtEbBiQAAAABJRU5ErkJggg==")}.jquery-todolist .jquery-todolist-item-done .jquery-todolist-item-title-text{text-decoration:line-through;font-style:italic;font-size:.9em}.jquery-todolist .jquery-todolist-item-done:hover .jquery-todolist-item-title-text{text-decoration:none}.jquery-todolist .jquery-todolist-hide-done .jquery-todolist-item-done{display:none}',t.fn.todoList=function(i){e.isInitDone||(e.isInitDone=!0,t("<style>"+e.styles+"</style>").appendTo("head"),t("body").on("click",function(e){var i,o=t("div.jquery-todolist-edit");o.length&&(i=t(e.target).closest(".jquery-todolist-action-edit"),i.length?o.each(function(){t.contains(i[0],this)||t(this).find(".jquery-todolist-edit-save").click()}):o.find(".jquery-todolist-edit-save").click()),o=t("div.jquery-todolist-menu:visible"),o.length}));var o=this;return this.each(function(){if(this.jqueryTodoList&&"string"==typeof i){switch(String(i).toLowerCase()){case"getsetup":o=this.jqueryTodoList.getSetup()}return this}if(t(this).hasClass("has-jquery-todolist"))return this;var n={$ele:t(this),opt:t.extend({},{title:"Todo List",items:[],removeLabel:"delete?",newItemPlaceholder:"New Item",editItemTooltip:"Click to Edit",focusOnTitle:!1,customActions:null},i),getSetup:function(){var e={title:n.$ui.find(".jquery-todolist-title-text").text(),items:[]};return n.getItems().each(function(){var i=t(this);e.items.push({done:i.is(".jquery-todolist-item-done"),title:i.find(".jquery-todolist-item-title-text").text()})}),e},addItem:function(o,d){var s=t(e.itemTemplate).find(".jquery-todolist-item-title-text").append(o.title).end().addClass(o.done?"jquery-todolist-item-done":"").find(".jquery-todolist-action-edit").attr("title",n.opt.editItemTooltip).end().appendTo(n.$ui.$items);return d||(n.$ele.trigger("todolist-add",i,n.$ele),n.$ele.trigger("todolist-change",i,n.$ele)),s},getItems:function(){return n.$ui.$items.find("div.jquery-todolist-item")},showEdit:function(o){var d=o.find(".jquery-todolist-item-title-text,.jquery-todolist-title-text").eq(0),s=t(e.itemEditTemplate).css("display","none").find("input").val(d.text()).end().appendTo(o),l=function(){d.html(s.find("input").val()),s.hide().delay("500").remove(),d.show(),o.addClass("jquery-todolist-action"),n.$ele.trigger("todolist-edit",i,n.$ele),n.$ele.trigger("todolist-change",i,n.$ele)};o.removeClass("jquery-todolist-action"),d.hide(),s.show().promise().then(function(){s.find("input").focus()}),s.find(".jquery-todolist-edit-save").on("click",l).end().find("input").on("keyup",function(t){13===t.which&&l()})},setupListMenu:function(){if(n.$ui.$menu=t(e.menuTemplate).css("display","none").appendTo(n.$ui),t.isArray(n.opt.customActions)){var o=n.$ui.$menu.find(".jquery-todolist-menu-items > a:first").clone(),d=t();t.each(n.opt.customActions,function(){if(t.isPlainObject(this)){var e=this;d=d.add(o.clone().text(this.title||"Action?").attr("data-todolistaction","custom action").click(function(){return t.isFunction(e.action)?e.action.call(n.$ele,i,e):void 0}))}}),n.$ui.$menu.find(".jquery-todolist-menu-items").append(d)}}};return n.$ui=t(e.listTemplate).appendTo(n.$ele.empty().addClass("has-jquery-todolist")).find(".jquery-todolist-title-text").html(n.opt.title).end().find(".jquery-todolist-add-input-text").attr("placeholder",n.opt.newItemPlaceholder).end().find(".jquery-todolist-action-edit").attr("title",n.opt.editItemTooltip).end(),n.$ui.$menu=null,n.$ui.$items=n.$ui.find("div.jquery-todolist-items"),n.$ui.$newItemInput=n.$ui.find("input.jquery-todolist-add-input-text"),n.$ui.$addButton=n.$ui.find(".jquery-todolist-add-action"),t.isArray(n.opt.items)&&t.each(n.opt.items,function(e,i){var o={title:"todo item",done:!1};t.isPlainObject(i)?t.extend(o,i):o.title=String(i)||"Item "+(e+1),n.addItem(o,!0)}),n.$ui.on("click.jqueryTodoList",".jquery-todolist-action",function(){var o,d=t(this);d.is(n.$ui.$addButton)?(o=n.$ui.$newItemInput.val(),o&&n.addItem({title:o}),n.$ui.$newItemInput.val(""),n.$ui.$newItemInput.focus()):d.is(".jquery-todolist-item-action-remove")?d.hide().closest(".jquery-todolist-item-actions-right").append(t(e.confirmButtonTemplate).find(".jquery-todolist-button-confirm").addClass("ui-state-error jquery-todolist-item-action-remove-confirmed").html(n.opt.removeLabel).end().find(".jquery-todolist-button-cancel").addClass("jquery-todolist-item-action-remove-cancel").end()):d.is(".jquery-todolist-item-action-remove-cancel")?d.closest(".jquery-todolist-item-actions-right").find(".jquery-todolist-item-action-remove").show().end().end().closest(".jquery-todolist-button").remove():d.is(".jquery-todolist-item-action-remove-confirmed")?(d.closest(".jquery-todolist-item").slideUp().promise().then(function(){t(this).remove()}),d.trigger("todolist-remove",i,d),d.trigger("todolist-change",i,d)):d.is(".jquery-todolist-item-checkbox")?(o=d.closest(".jquery-todolist-item"),o.hasClass("jquery-todolist-item-done")?(o.removeClass("jquery-todolist-item-done"),d.trigger("todolist-unchecked",i,d),d.trigger("todolist-change",i,d)):(o.addClass("jquery-todolist-item-done"),d.trigger("todolist-checked",i,d),d.trigger("todolist-change",i,d))):d.is(".jquery-todolist-action-edit")?n.showEdit(d):d.is(".jquery-todolist-menu-show")?(n.$ui.$menu||n.setupListMenu(),n.$ui.$menu.is(":visible")?n.$ui.$menu.hide():n.$ui.$menu.show()):d.is(".jquery-todolist-menu-item")?("toggle done"===d.data("todolistaction")&&(n.$ui.$items.hasClass("jquery-todolist-hide-done")?n.$ui.$items.removeClass("jquery-todolist-hide-done"):n.$ui.$items.addClass("jquery-todolist-hide-done")),d.closest(".jquery-todolist-menu").hide()):"close menu"===d.data("todolistaction")&&d.closest(".jquery-todolist-menu").hide()}),n.$ui.$newItemInput.on("keyup",function(t){13===t.which&&n.$ui.$addButton.click()}),this.jqueryTodoList=n,n.$ui.css("display",""),n.opt.focusOnTitle&&setTimeout(function(){n.$ui.find("div.jquery-todolist-title").find(".jquery-todolist-title-text").click().end().find("input").select()},500),this}),o}});