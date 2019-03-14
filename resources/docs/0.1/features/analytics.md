# Analytics

---

- [Dashboard](#dashboard)
- [Event Types](#event-types)
- [Custom Events](#custom-events)

<a id="dashboard"></a>
## Dashboard
<img src="/images/docs/analytics-dashboard.png" class="raised" />

<a id="event-types"></a>
## Event Types
Out of the box, Startup Engine automatically tracks a handful of predefined events:

- Page Views
- Content Views
- Clicks
- Subscription Events (subscribe / unsubscribe / change plan)

<a id="custom-events"></a>
## Custom Events

If you would like to track your own custom events, it's as simple as posting JSON data to the API endpoint.  

<div class="code-header"><span style="opacity:0.95;" class="badge badge-dark">POST</span> <span style="opacity:0.95;" class="badge badge-light">api / analytics / event</span></div>

```json     
{
  "json":{
    "custom_integer_field": 123,
    "custom_text_field": "Text"
  }
}                      
```

If you would like to attribute it to a user, simply provide a `user_email` or `user_id` field, like so:

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
