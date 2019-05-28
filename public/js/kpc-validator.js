function validate(id,rules,val)
{
  var errors = 0;

    //basic validation

    if(testBlank(id,rules,val)){
      errors += 1;
    }else if(testMinLength(id,rules,val)){
      errors += 1;
    }else if(testMaxLength(id,rules,val)){
      errors += 1;
    }

    //specific type validation
    if( rules.type == 'email' && !errors)
    {
      if(testEmail(id,rules,val)){
        errors += 1;
      }
    }

    if( rules.type == 'numeric' && !errors)
    {
      if(testNumeric(id,rules,val)){
        errors += 1;
      }
    }

    if( rules.type == 'image' && !errors)
    {
      if(testImage(id,rules,val)){
        errors += 1;
      }
    }


    if( errors )
    {
      //$("#"+id).css('border-color','#d9534f');
    }
    else
    {
      if( val.length != 0 )
      {
        //$("#"+id).css('border-color','#5cb85c');
      }
      else{
        //$("#"+id).css('border-color','');
      }
      $("#"+id+"Helper").text('');
    }

  return
}


//function to test blank value for required field
function testBlank(id,rules,val)
{
  if(val == '' && rules.required == 1)
  {
    $("#"+id+"Helper").text('This is a required field');
    $("#"+id+"Title").removeClass('has-success').addClass('has-error');
    return 1;
  }
  $("#"+id+"Title").addClass('has-success').removeClass('has-error');
  return 0;
}

//function to test minimum length of a field's value
function testMinLength(id,rules,val)
{
  if(rules.min > val.length && val.length != 0)
  {
    $("#"+id+"Helper").text('Please type atleast '+rules.min+' characters.');
    $("#"+id+"Title").removeClass('has-success').addClass('has-error');

    return 1;
  }
  $("#"+id+"Title").addClass('has-success').removeClass('has-error');
  return 0;
}

//function to test maximum length of a field's value
function testMaxLength(id,rules,val)
{
  if(rules.max < val.length)
  {
    $("#"+id+"Helper").text('Too long text for this field.');
    $("#"+id+"Title").removeClass('has-success').addClass('has-error');

    return 1;
  }
  $("#"+id+"Title").addClass('has-success').removeClass('has-error');

  return 0;
}

//function to validate email
function testEmail(id,rules,val)
{
  var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(!pattern.test(val))
  {
    $("#"+id+"Helper").text('This email is invalid.');
    $("#"+id+"Title").removeClass('has-success').addClass('has-error');

    return 1;
  }
  $("#"+id+"Title").addClass('has-success').removeClass('has-error');

  return 0;
}

//function to test if a field's value is numeric
function testNumeric(id,rules,val)
{
  if(isNaN(val))
  {
    $("#"+id+"Helper").text('Please enter valid digits only.');
    $("#"+id+"Title").removeClass('has-success').addClass('has-error');

    return 1;
  }
  $("#"+id+"Title").addClass('has-success').removeClass('has-error');

  return 0;
}

//function to test image
function testImage(id,rules,val)
{
  var reg = /(.*?)\.(jpg|bmp|jpeg|png)$/;
  var uploadedFile = document.getElementById(id);
  var fileSize = uploadedFile.files[0].size / 1024 / 1024; //size in mb

  if( !val.match(reg) )
  {
    $("#"+id+"Helper").text('Invalid image. Select a jpeg, png or gif files only.');
    $("#"+id+"Title").removeClass('has-success').addClass('has-error');

    return 1;
  }

  if( fileSize > rules.size )
  {
    $("#"+id+"Helper").text('Invalid size. Select a file of less than '+ rules.size+'MB.');
    $("#"+id+"Title").removeClass('has-success').addClass('has-error');

    return 1;
  }
  $("#"+id+"Title").addClass('has-success').removeClass('has-error');
  return 0;
}
