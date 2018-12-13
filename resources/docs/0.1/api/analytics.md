# Analytics

---
- [Analytic Events](#custom-events)

<a id="custom-events"></a>
## Analytic Events  

<div class="code-header"><span class="badge badge-light-outline" style="opacity: 0.95;">Payload</span>
<span class="badge badge-light" style="opacity: 0.95;">Response</span></div>

<div class="code-meta"><span style="opacity:0.95;" class="badge badge-dark">POST</span> <span style="opacity:0.95;" class="badge badge-light">api / analytics / event</span></div>

```json     
{
  "json":{
    "custom_integer_field": 123,
    "custom_text_field": "Text"
  }
}                      
```

<div class="code-header code-header-flush"><span style="opacity:0.95;" class="badge badge-light badge-light-outline">RESPONSE</span></div>

```json  
{
	"created_at": "2018-10-23 05:28:58",
	"status": "success"	
}                   
```


If you would like to attribute an event to a user, simply provide a `user_email` or `user_id` field, like so:

```json  
{
  "user_email": "user@example.com",
  "json":{
    "custom_integer_field": 123,
    "custom_text_field": "Text"
  }
}  
```

```json  
{
  "user_id": 1, // can be integer or HashID
  "json":{
    "custom_integer_field": 123,
    "custom_text_field": "Text"
  }
}                      
```
