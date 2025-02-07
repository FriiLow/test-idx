import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [
        "collectionContainer",
        "rule",
    ];

    static values = {
        index: Number,
        prototype: String,
    }

    addCollectionElement(event)
    {
        const item = document.createElement('li');
        item.innerHTML = this.prototypeValue.replace(/__name__/g, this.indexValue);

        this.collectionContainerTarget.appendChild(item);

        this.indexValue++;
    }

    removeCollectionElement(event)
    {
        const target = event.target;

        target.closest('li').remove();
    }

    ruleTargetConnected(element) {
        const removeButton = document.createElement('button');
        removeButton.innerHTML = 'X';
        removeButton.dataset.action = "click->form-collection#removeCollectionElement";

        element.appendChild(removeButton);
    }
}
