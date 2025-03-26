export default function typingEffect() {
    return {
        texts: ['una missione', 'una passione', 'una dedizione'], // Array con solo le parole da digitare
        currentText: 0,
        displayText: "",
        speed: 100, // Velocità di digitazione (in ms)
        pauseBetweenTexts: 1000,
        startTyping() {
            this.displayText = ""; // Resetta il testo visualizzato
            let fullText = this.texts[this.currentText];
            let i = 0;

            let typingInterval = setInterval(() => {
                if (i < fullText.length) {
                    this.displayText += fullText[i];
                    i++;
                } else {
                    clearInterval(typingInterval);
                    setTimeout(() => {
                        this.currentText++;
                        if (this.currentText >= this.texts.length) {
                            this.currentText = 0; // Ritorna al primo testo
                        }
                        this.startTyping();
                    }, this.pauseBetweenTexts); // Ritardo prima del prossimo testo
                }
            }, this.speed);
        },
        init() {
            this.startTyping();
        }
    };
}