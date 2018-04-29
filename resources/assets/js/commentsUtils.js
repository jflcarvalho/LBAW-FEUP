var Mustache = require('mustache');

import { editCommentsEventListener } from './comments.js'

export function createComments(response, message_id, isAuthenticated) {

    if (response.comments.length == 0)
        return;

    let template = document.querySelector("template.comments").innerHTML;
    let placeholder = document.createElement("span");

    placeholder.innerHTML = Mustache.render(template, response);

    let final = getCommentsDropDown(message_id);
    if (final.firstChild == null)
        final.appendChild(placeholder);
    else
        final.replaceChild(placeholder, final.firstChild);

    toggleShowMsg(message_id, false);

    // Adding event listener to freshly added html
    editCommentsEventListener();
}

export function createCommentHTML(comment, isAuthenticated) {

    let template = document.querySelector("template.comment").innerHTML;

    return Mustache.render(template, comment);
}

export function getCommentsDropDown(message_id) {
    let commentSelector = ".answer-comments[data-message-id='" + message_id + "']";
    return document.querySelector(commentSelector);
}

export function getCommentsURL(message_id) {
    return window.location.pathname + '/answers/' + message_id + '/comments';
}

export function getUniqueCommentURL(commentable_id, comment_id) {
    return getCommentsURL(commentable_id) + '/' + comment_id;
}

/**
 * 
 * @param {String} message_id 
 * @param {boolean} show - If true, it's supposed to to 'Show Comments' , if false it's supposed to 'Hide Comments'
 */
export function toggleShowMsg(message_id, show) {
    let toggler = document.querySelector("a[aria-controls='AnswerComments" + message_id + "']");

    toggler.innerHTML = (show ? "Show" : "Hide") + " Comments";
}
