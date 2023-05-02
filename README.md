<div align="center">
    <h1>Our Place</h1>
</div>

* [Business Rules](## Business Rules)

## Business Rules

### Users
The people who use the site  
* Can make many posts
* Can follow many other users
* Track:  
  * User ID: a unique, hidden value to identify each user
  * Username: a unique, publicly visible name for each user
  * Password: an encrypted, hidden value for authentication
  * Description: an optional, publicly displayed description of the user
  * Status: a short description of what the user is doing
  * Profile picture: a circular picture displayed on posts
  * External link: an optional link to any page the user wants
  * Is admin: if the user is an admin, which gives elevated permissions
  * Joined on: a timestamp that shows when the user made their account

### Posts
Content created by the users in a channel  
* Posts are made by one and only one user
* Posts can be reacted to by many users
* Track:
  * Post ID: unique identifier for each post
  * Channel ID: ID of the channel the post is in
  * Author ID: ID of the user who made the post
  * Title: user-inputted subject of the post
  * Content: the text of the post
  * Attachment: an optional image to be displayed under the post
  * Reply to: if the post is responding to another, this holds the post ID
  * Created on: the datetime the post was made

### Channels
A container for posts of a specified topic  
* Made by one user
* Can have no or many posts
* Track:
  * Channel ID: unique identifier of the channel
  * Created by: the user who created the channel
  * Name: the name of the channel
  * Description: text that describes what messages should be in a channel
  * Created on: the time the channel was created

### Likes
The relationship between users and posts  
* A post can be liked by many users
* A user may like many posts
* A user may not both like and dislike a post
* A user may react to their own post
* Track:
  * User ID: the ID of the user in question
  * Post ID: the ID of the post
  * Liked on: the time the post was liked, if this is filled, the user has liked the post
  * Disliked on: the time a post was disliked by a user

### Follows
The relationship between two users  
* A user may follow many other users
* One user may have many followers
* Track:
  * User 1 ID: the ID of the first user
  * User ID 2: the ID of the second user
  * User 1 followed user 2 on: the time user 1 followed user 2, null if user 1 is not following user 2
