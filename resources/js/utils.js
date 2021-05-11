export function gqlErrors(error) {
    const hasInternal = errors => errors.some(e => e.internal);
    const replaceInternal = (errors, err) => hasInternal(errors)
        ? errors.filter(e => !e.internal).concat(err)
        : errors;

    return replaceInternal((error?.graphQLErrors || []).map(err => {
        if ("validation" === err?.extensions?.category) {
            const validationErrors = err.extensions?.validation || {};
            Object.keys(validationErrors).map(key => validationErrors[key]);

            return Object.keys(validationErrors).map(key => validationErrors[key]).flat().map(v => ({
                message: v,
                internal: false
            }));
        }
        return {
            message: err.message,
            internal: Boolean(!(error?.path?.length))
        }
    }), {
        message: 'Something gone wrong',
    }).flat();
}
