// Creates array of connections between students
export const getStudentsConnections = (students, sociogramData) => {
    const studentsConnections = [];
    for (var i = 0; i < sociogramData.length; i++) {
        var student1 = students[i].id;
        var student1Connections = sociogramData[i];
        Object.entries(student1Connections).forEach((connection, index) => {
            var student2 = connection[0];
            var weight = connection[1];
            studentsConnections.push({
                from: student1,
                to: student2,
                value: weight,
                title: weight,
            });
        });
    }
    return studentsConnections;
}