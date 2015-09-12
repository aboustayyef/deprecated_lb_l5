#Spec for Lebanese Blogs

## Summary
Lebanese Blogs is a service that gathers, aggregates and filters content from Lebanese blogs and columns. Users can subscribe to sources (bloggers and columnists), and like specific posts for future reference.

## Posts

Posts are blog posts or columns produced by Lebanese Blogs Sources.

### Gathering the posts
* Every 10 minutes, a Crawler checks the sources for new online posts
* The posts are then compared to the ones in the database, and new ones will be saved.

### Saving new posts
* When saved, each post is assigned to one or two channel(s). Same as default channel(s) of source.
* The largest image in a post is found and cached and associated to post;
* Content is analyzed for a _rating_ signature. If one is found, it is converted to a star rating over 5.

### Virality
* Every 10 minutes, a Crawler goes through the posts published in the last 12 hours and calculates Virality.
* every 24 hours, a Crawler goes through the posts published in the last month to calculate virality.
* A post has many viralities (changes with time). will be used to graph progress throughout the day.

## Sources

Sources are bloggers and columnists who produce the posts

### Adding New Sources
* A new source can be added via a form by the site's administrator
* A source can either be a blog with RSS feed or part of a media parent.
* If a post doesn't have an RSS feed, it will be considered part of a larger media parent
* Each media parent should have specialized crawlers for their content.



##Channels