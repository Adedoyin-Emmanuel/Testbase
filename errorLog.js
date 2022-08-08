  const Error_Log = (color, err) => {
      if (typeof err == undefined) throw new Error("Error Is Not Defined");
      //create custom error
      this.color = color;
      this.err = err;
      //set the attribute for the color
      errorLog.style.color = color.string;
      errorLog.innerHTML = err.toString();

  }