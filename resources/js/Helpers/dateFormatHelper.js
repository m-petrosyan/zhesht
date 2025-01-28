import moment from 'moment-timezone';

export const formatDateTime = (dateTime, outputFormat = 'DD/MM/YYYY HH:mm') => {
    return moment(dateTime).format('D MMMM YYYY HH:mm')
};
