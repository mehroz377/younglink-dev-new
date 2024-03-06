// Filters out entries with 0 weight connections
export const filterRelevantConnections = (sociogramData) => {
    return sociogramData.map(obj => {
        return Object.entries(obj).reduce((newObj, [key, value]) => {
            if (value !== 0) {
                newObj[key] = value;
            }
            return newObj;
        }, {});
    });
}