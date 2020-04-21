/**
 * js/app/activity.js
 */

let ajax = require('Services/ajax');

let activity = {};

activity.updateTasksOrder = function(activityId, tasksOrder) {

    let route = {
        name: 'activities.update-tasks-order',
        params: {
            activity: activityId
        }
    };

    let data = {
        orderedTasks: tasksOrder
    };

    return ajax.post(route, data);
};

module.exports = activity;
