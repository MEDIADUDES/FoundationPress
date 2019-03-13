module.exports = {
	check: {
		options: {
			updateType: 'force', // update packages if new version is wanted.
			reportUpdated: false, // don't report up-to-date packages
			semver: true, // stay within semver when updating
			packages: {
				devDependencies: true, // only check for devDependencies
				dependencies: true,
			},
			packageJson: null, // use matchdep default findup to locate package.json
			reportOnlyPkgs: [], // use updateType action on all packages
		},
	},
	update: {
		options: {
			updateType: 'force', // just report outdated packages
			reportUpdated: false, // don't report up-to-date packages
			semver: false, // force update and do not stay within specified semver.
			packages: {
				devDependencies: true, // only check for devDependencies
				dependencies: true,
			},
			packageJson: null, // use matchdep default findup to locate package.json
			reportOnlyPkgs: [], // use updateType action on all packages
		},
	},
};
