# Users

---

- [Browse Users](#browse-users)

<a id="browse-users"></a>
## Browse Users

<div class="code-header"><span style="opacity:0.95;" class="badge badge-dark">GET</span> <span style="opacity:0.95;" class="badge badge-light">api / users </span></div>

```json     
{
	"current_page": 1,
	"data": [
		{
			"id": 7,
			"name": "Nate Silver",
			"email": "analyst@example.comadg",
			"avatar": "http:\/\/127.0.0.1:8000\/images\/avatar.png",
			"created_at": "2018-05-31 00:27:23",
			"updated_at": "2018-05-31 00:27:23",
			"role_id": null,
			"status": "INACTIVE",
			"deleted_at": null,
			"published_at": null,
			"stripe_id": null,
			"card_brand": null,
			"card_last_four": null,
			"trial_ends_at": null,
			"bio": null,
			"member_since": "4 months ago",
			"last_active": "4 months ago"
		}
	],
	"first_page_url": "http:\/\/127.0.0.1:8000\/api\/users?page=1",
	"from": 1,
	"next_page_url": "http:\/\/127.0.0.1:8000\/api\/users?page=2",
	"path": "http:\/\/127.0.0.1:8000\/api\/users",
	"per_page": 10,
	"prev_page_url": null,
	"to": 10,
	"total": 1,
	"pages": 1
}                  
```