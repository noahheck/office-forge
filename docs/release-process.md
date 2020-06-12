# Release Cycle

*Note - as with everything, there is room to improve this process. Please feel free to share your thoughts on how we can improve by opening an issue.*

One of the overarching ideas within Office Forge is that clear development of business activities as processes can improve an organization's performance, and our most important activity is delivering quality software to our users. Our users deserve a regular, predictable upgrade schedule that they can organize around their own business processes.

We opt for a relatively short, monthly release cadence for a couple of reasons. A short release cycle gets new features in the hands of our users faster, allowing us to get feedback from them quicker. This helps ensure we don't spend too much time heading in the wrong direction, and instead lets us make smaller adjustments to meet user's needs.

A short release cycle also helps us focus on creating incremental improvements. It's very unlikely that the first version of a feature will be its final form; after all, 4 weeks is not a long time when it comes to feature development. We don't ship broken features though, and a *lovable* version of almost any feature is possible to create in 4 weeks.

## Release Process

Around the first of the month, we create a new release branch from the current main and give it an appropriate name: e.g., release-2020-06 for the June 2020 release. Between then and release day, no new features will be included in the release (feature freeze). Bug hunting and feature polishing PRs during that time should be created for the release branch as well as into main.

Beta releases may be tagged periodically during the release period. We do our best to apply the principles of semantic versioning.
 
We publish a new version of Office Forge on the 7th of each month.

## Pull Requests

We don't like old, stale pull requests; the PR should be created when it's ready to be merged (we'll perform each merge into the release branch as a squash commit, but feel free to create whatever incremental commits you desire on your branch). After a PR is accepted, it will get deployed with the next release, so it needs to be functional as-is. We don't, however, expect it to be feature complete. There's time in the next cycle (or the one after that!) to iron out the kinks and get it completed. There's never an expectation that a first iteration will be perfect.
