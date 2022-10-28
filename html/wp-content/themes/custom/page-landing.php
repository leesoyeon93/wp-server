<?php 
/*
Template name: Page - Landing
*/


// wp_create_user( $username, $password, $email );

// wp_insert_user( array(
// 	'user_login' => $username,
// 	'user_pass' => $password,
// 	'role' => 'subscriber'
// ));
// ?>


<style>
    form{
        width : 250px;
    }
    input,select,button{
        width : 100%;
        height:30px;
        margin-bottom:20px;
    }
    button{
        background-color: #000;
        color:#fff;
        border: 0;
        border-radius : 10px;
    }
</style>

<a href="/wp-login.php">wordpress Login</a>
<h1>custom rest </h1>
<form method="POST" action="/wp-json/register/v1/receive-callback">
    <input type="email" name="email" placeholder="email"><br/>
    <input type="text" name="username" placeholder="username"><br/>
    <input type="password" name="password" placeholder="password"><br/>
    <select name="role" value="subscriber">
        <option value="subscriber">subscriber</option>
        <option value="author">author</option>
        <option value="editor">editor</option>
        <option value="administrator">administrator</option>
    </select>
    <button type="submit">가입</button>
</form>



