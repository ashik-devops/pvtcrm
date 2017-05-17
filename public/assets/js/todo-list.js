$(document).ready(function() {
	'use strict';

	/* ======= jQuery TodoList ====== */
	/* Ref: https://github.com/purtuga/jquery.todoList */
	$("#todo-list-1").todoList({
		title: "Todo List",
		items: [
			{
				title: "task 1",
				done:   true
			},

			{
				title: "task 2",
				done:   true
			},

			{
				title: "task 3",
				done:   true
			},

			{
				title: "task 4"
			},
			{
				title: "task 5"
			},
			{
				title: "task 6"
			}
		],
		removeLabel: "Delete?",
		newItemPlaceholder: "Add a new item",
		editItemTooltip: "Click to edit",
		focusOnTitle: false
	});
});
