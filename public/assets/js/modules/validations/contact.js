export let contactValidate = {


  email : function() {
 
    let str = this.value;
    let res = str.match(/[a-z0-9._%+-]+@[a-z0-9]+\.[a-z]{2,3}$/g);
    let feedback = document.querySelector('.feedback-email');

    switch (Boolean(res)) {

      case true:

        this.classList.add('is-valid');
        feedback.innerText = '';

        if( this.classList.contains('is-invalid') ) {

            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        }

        if( feedback.classList.contains('invalid-feedback') ) {

          feedback.classList.remove('invalid-feedback');
          feedback.classList.add('valid-feedback');

        } 
        break;

      case false:

        this.classList.add('is-invalid');
        feedback.innerText = 'Must be a valid email';

        if( this.classList.contains('is-valid') ) {

            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
        }

        if( !feedback.classList.contains('invalid-feedback') ) {

          feedback.classList.remove('valid-feedback');
          feedback.classList.add('invalid-feedback');
        } 

        break;
    }
  },

  recipient: function() {
 
    let str = this.value;
    let res = str.match(/[a-z0-9._%+-]+@[a-z0-9]+\.[a-z]{2,3}$/g);
    let feedback = document.querySelector('.feedback-recipient');

    switch (Boolean(res)) {

      case true:

        this.classList.add('is-valid');
        feedback.innerText = '';

        if( this.classList.contains('is-invalid') ) {

            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        }

        if( feedback.classList.contains('invalid-feedback') ) {

          feedback.classList.remove('invalid-feedback');
          feedback.classList.add('valid-feedback');

        } 
        break;

      case false:

        this.classList.add('is-invalid');
        feedback.innerText = 'Must be a valid email';

        if( this.classList.contains('is-valid') ) {
          
            this.classList.remove('is-valid');
            this.classList.add('is-invalid');
        }

        if( !feedback.classList.contains('invalid-feedback') ) {

          feedback.classList.remove('valid-feedback');
          feedback.classList.add('invalid-feedback');
        }
    }
 }


}