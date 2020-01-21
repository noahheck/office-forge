/**
 * js/app/process/task.js
 */

let ajax = require('Services/ajax');

let task = {};

task.updateActionsOrder = function(processId, taskId, actionsOrder) {

    let route = {
        name: 'admin.processes.tasks.actions.update-order',
        params: {
            process: processId,
            task: taskId
        }
    };

    let data = {
        orderedActions: actionsOrder
    };

    return ajax.post(route, data);
};

module.exports = task;
