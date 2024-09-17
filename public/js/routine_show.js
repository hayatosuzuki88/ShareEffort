

const formMinutesValue = document.forms.routine_form.minutes_value; 
const formBodyValue = document.forms.routine_form.body_value; 

formMinutesValue.addEventListener('input',()=>{     
  let minutes  = document.getElementById('minutes');
  minutes.textContent = "頑張った時間："+ formMinutesValue.value +"分間";
})

formBodyValue.addEventListener('input',()=>{     
  let body  = document.getElementById('body');
  body.textContent = formBodyValue.value;
})
