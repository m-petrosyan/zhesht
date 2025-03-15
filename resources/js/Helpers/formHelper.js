import {useForm} from "@inertiajs/vue3";

const useFormHelper = (initialValues) => {
    console.log(initialValues)
    const data = {
        ...initialValues,
        _method: initialValues.id ? 'PUT' : 'POST'
    };

    return useForm(data);
};

export default useFormHelper;
