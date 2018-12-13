# Products

---

- [Browse Products](#browse-products)
- [Pricing Plans](#plans)

<a id="browse-products"></a>
## Browse Products

<div class="code-header"><span style="opacity:0.95;" class="badge badge-dark">GET</span> <span style="opacity:0.95;" class="badge badge-light">api / products</span></div>

```json     
{
	"current_page": 1,
	"data": [
		{
			"id": 47,
			"created_at": "2018-09-05 06:29:54",
			"updated_at": "2018-09-06 06:05:43",
			"name": "999",
			"slug": null,
			"price": null,
			"description": null,
			"image": null,
			"json": "{\"sections\":{\"about\":{\"fields\":{\"type\":\"Physical Product\"}}}}",
			"stripe_id": "prod_DY0TRoG2nkVKhs",
			"status": "INACTIVE",
			"priority": null,
			"remote_data": "{\"id\":\"prod_DY0TRoG2nkVKhs\",\"object\":\"product\",\"active\":true,\"attributes\":[],\"caption\":null,\"created\":1536128762,\"deactivate_on\":[],\"description\":null,\"images\":[],\"livemode\":false,\"metadata\":[],\"name\":\"999\",\"package_dimensions\":null,\"shippable\":null,\"skus\":{\"object\":\"list\",\"data\":[],\"has_more\":false,\"total_count\":0,\"url\":\"\\\/v1\\\/skus?product=prod_DY0TRoG2nkVKhs&active=true\"},\"statement_descriptor\":null,\"type\":\"service\",\"unit_label\":null,\"updated\":1536128762,\"url\":null}",
			"deleted_at": null,
			"last_updated": "1 month ago",
			"tags": [],
			"content": {
				"sections": {
					"about": {
						"fields": {
							"type": "Physical Product"
						}
					}
				}
			},
			"tagged": []
		}
    ],
	"first_page_url": "http:\/\/127.0.0.1:8000\/api\/products?page=1",
	"from": 1,
	"next_page_url": "http:\/\/127.0.0.1:8000\/api\/products?page=2",
	"path": "http:\/\/127.0.0.1:8000\/api\/products",
	"per_page": 10,
	"prev_page_url": null,
	"to": 1,
	"total": 1,
	"pages": 1
}                
```

<a id="plans"></a>
## Pricing Plans

<div class="code-header"><span style="opacity:0.95;" class="badge badge-dark">GET</span> <span style="opacity:0.95;" class="badge badge-light">api / products / plans<span class="text-success"> ?product_id=1</span></span></div>

```json     
{
	"status": "success",
	"message": "Product found.",
	"total": 0,
	"pages": 1,
	"data": []	
}                
```