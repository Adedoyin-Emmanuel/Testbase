
class TypingEffect{
	constructor(text,DOM_ID,textSpeed,index){
		this.text=text;
		this.textSpeed=textSpeed;
		this.index=index;
		this.DOM_ID=DOM_ID;
		this.textElapsed=false;

		this.removeText=()=>{
			
			this.DOM_ID.value = " ";
		}

		this.updateText=()=>{

			if(this.index < this.text.length){

				this.DOM_ID.value += this.text.charAt(this.index);
				
				this.index++;

				setTimeout(this.updateText,this.textSpeed);
			}

			if(this.index == this.text.length){
				this.removeText();
				this.index=0;
				this.textElapsed=true;
			}
		}
	}
}

