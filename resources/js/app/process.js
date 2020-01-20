/**
 * js/app/process.js
 */

let ajax = require('Services/ajax');

let process = {};

process.updateTasksOrder = function(processId, tasksOrder) {

    let route = {
        name: 'admin.processes.tasks.update-order',
        params: {
            process: processId
        }
    };

    let data = {
        orderedTasks: tasksOrder
    };

    return ajax.post(route, data);
};

module.exports = process;
