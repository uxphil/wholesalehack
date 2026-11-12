# wholesalehack: notes for Claude

## Check for work left by other sessions

Work is often started in one Claude session (on the web, on a phone or on the Mac) and continued in another. Before starting on a new request, check whether an earlier session left something unfinished:

1. Run `git fetch origin --prune`. Then list remote branches whose names start with `claude/` and that are not merged into the default branch. For each one, list the Markdown files it adds or changes (`git diff --name-only origin/HEAD...<branch> -- '*.md'`).
2. Look for handoff notes in `docs/`. These are files with a `**Status:**` line near the top that doesn't say `done`, or that have a "Next steps" checklist with unticked boxes. Check those branches as well as the default branch.
3. If you find any, give me a one-line summary of each, including its branch and file. Ask whether to pick one up before you carry on with what I asked. Don't act on them without asking.

If there's nothing open, say nothing about it.

## Writing a handoff note

When we stop partway through something, write it up in `docs/` as a Markdown file so a later session can carry on. Create the folder if it doesn't exist.

- Put a `**Status:**` line at the top: `open`, `waiting for a decision` or `done`.
- Say what was found, what was decided and what is still to do, with a "Next steps" checklist.
- Commit it and push it.
- When the work is finished, set the status to `done`.
