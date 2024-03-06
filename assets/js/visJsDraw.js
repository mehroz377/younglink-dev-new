import vis from 'vis-network/standalone/umd/vis-network.min.js';
import { getStudentsRelevantData } from './getStudentsRelevantData';
import { filterRelevantConnections } from './filterRelevantConnections';
import { getStudentsConnections } from './getStudentsConnections';
import { visOptions } from './visJsOptions';

// Draws VisJs network graph
export const visJsDraw = (reportAllData, dataSource, genderIcons, targetElId) => {
    const sociogramData = reportAllData.classroom_level_variables.sociograms[dataSource];
    const studentsData = reportAllData.student_level_variables.student_attributes;

    // fill nodes with students
    var nodes = getStudentsRelevantData(studentsData, genderIcons);
    // filter out 0 weight connections
    var filteredConnections = filterRelevantConnections(sociogramData);
    // fill edges with connections between students
    var edges = getStudentsConnections(nodes, filteredConnections);

    // Instantiate our network object.
    var container = document.getElementById(targetElId);
    var data = {
        nodes: nodes,
        edges: edges,
    };
    var options = visOptions;
    var network = new vis.Network(container, data, options);
}