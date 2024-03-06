export const visOptions = {
    height: "400px",
    nodes: {
        borderWidth: 0,
        font: {
            color: "#251D33",
            size: 12,
            background: "#FFFFFF",
        },
        shape: "dot",
        borderWidthSelected: 2,
    },
    edges: {
        arrows: {
            to: {
                enabled: true,
                scaleFactor: 0.5,
            }
        },
        color: {
            color: "#A6A6A6",
            highlight: "#5846CF",
            hover: "#5846CF",
            opacity: 1.0,
        },
        scaling: {
            min: 0.1,
            max: 2,
        },
        physics: false,
        selectionWidth: 0.5,
        smooth: false,
        width: 0.1,
    },
};