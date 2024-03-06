// Generate array of objects with student id and label
export const getStudentsRelevantData = (studentsData, genderIcons) => {
    const students = [];
    Object.values(studentsData).forEach(student => {
        const colorByGender = student.gender === 'male' ? '#FFE5E5' : '#F1EFFD';
        const imgByGender = student.gender === 'male' ? genderIcons.male : genderIcons.female;
        students.push({
            id: student.studentID,
            label: student.studentID,
            shape: 'circularImage',
            color: {
                background: colorByGender,
                highlight: {
                    border: '#5846CF',
                    background: colorByGender,
                },
            },
            image: imgByGender,
            imagePadding: 7,
            size: 22,
        });
    });
    return students;
}