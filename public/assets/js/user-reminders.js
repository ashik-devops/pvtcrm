$(document).ready(function() {
	'use strict';

	/* ======= jQuery TodoList ====== */
	/* Ref: https://github.com/purtuga/jquery.todoList */
	$("#my-todo-list").todoList({
		title: "My TODO List",
		items: [
			{
				title: "Create UX deck for Nike",
			},
			{
				title: "Send email to Julie",
				done:   true
			},
			{
				title: "Prepare meetup presentation"
			},
			{
				title: "Wireframes for Project Lorem Ipsum"
			},
			{
				title: "Research apps for sports",
				done:   true
			},
			{
				title: "Research iWatch apps"
			},
			{
				title: "Design UI for Lorem Android app"
			}
		],
		removeLabel: "Delete?",
		newItemPlaceholder: "Add a new item",
		editItemTooltip: "Click to edit",
		focusOnTitle: false
	});
});
