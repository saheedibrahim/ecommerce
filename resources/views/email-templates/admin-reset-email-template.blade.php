<p>Dear {{ $admin->name }}</p>
<br>
<p>
    Your password on laravecom system was changed successfully.
    Here is your new login credentials:
    <br>
    <b>Login ID: </b>{{ $admin->username }} or {{ $admin->email }}
    <br>
    <b>Password: </b>{{ $new_password }}
    {{-- <b>Password: </b>{{ $admin->new_password }} --}}
</p>
<br>
Please keep your credentials confidential, your username and password are your own credentials and you should
 never share the with anybody else.
 <p>
    laravecom will not be liable for any misuse of your username or password.
 </p>
 <br>
 .........................................................
 <p>
    This email was automatically sent by laravecom system. Do not reply it.
 </p>