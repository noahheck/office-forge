# Release Cycle

*Note - as with everything, there is room to improve this process. Please feel free to share your thoughts on how we can improve by opening an issue.*

One of the overarching ideas within Office Forge is that clear development of business activities as processes can improve an organization's performance, and our most important activity is delivering quality software to our users. Our users deserve a regular, predictable upgrade schedule that they can organize around their own business processes.

We opt for a relatively short, monthly release cadence for a couple of reasons. A short release cycle gets new features in the hands of our users faster, allowing us to get feedback from them quicker. This helps ensure we don't spend too much time heading in the wrong direction, and instead lets us make smaller adjustments to meet user's needs.

A short release cycle also helps us focus on creating incremental improvements. It's very unlikely that the first version of a feature will be its final form; after all, 4 weeks is not a long time when it comes to feature development. We don't ship broken features though, and a *lovable* version of almost any feature is possible to create in 4 weeks.

New versions are published on the 7th of each month.

To keep git-based deployments less complex, we consider the master branch our production-deployable code. When a release cycle begins, a new release branch is to be created from the current master and given an appropriate name: e.g., release-2020-06 for the June 2020 release. New product work for that release cycle should be PR-ed into that release branch.

With very limited exception, PRs should always be targeted to the current release branch. We don't like old, stale pull requests; the PR should be created when it's ready to be merged (we'll perform each merge into the release branch as a squash commit, but feel free to create whatever incremental commits you desire on your branch). After a PR is accepted, it will get deployed with the next release, so it needs to be functional as-is. We don't, however, expect it to be feature complete. There's time in the next cycle (or the one after that) to iron out the kinks and get it completed. There's never an expectation that a first iteration will be perfect.

Beginning on the first of the month, we generally change our focus from feature work to polishing the new release. We do our best to ensure new features function as they are intended to. We write a blog post announcing the exciting new features and any deprecations that come up during the release.

On the 7th, we merge the release branch into the master branch and publish a new version of Office Forge.
