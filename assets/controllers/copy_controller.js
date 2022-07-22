import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = [
        'input',
        'output'
    ];

    connect() {
        this.outputTarget.innerText = 'Write text in input';
    }

    onInput() {
        this.outputTarget.innerText = `Stimulus copy text from input: ${this.inputTarget.value}`;
    }
}
