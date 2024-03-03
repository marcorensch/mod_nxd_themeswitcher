const steps = [
    {
        selector: 'select#jform_position',
        findParent: true,
        intro: 'Set \"Status\" as Position.',
        position: 'left'
    },
    {
        selector: 'select#jform_published',
        findParent: true,
        intro: 'Set Status to \"Published\".',
        position: 'left'
    },
    {
        selector: 'select#jform_access',
        findParent: true,
        intro: 'Set Access to \"Special\".',
        position: 'left'
    },
    {
        selector: 'joomla-toolbar-button#toolbar-apply',
        findParent: false,
        intro: 'Click now on Save.',
        position: 'bottom'
    },

];

export {steps};