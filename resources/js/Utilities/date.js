import { formatDistance, parseISO, format } from "date-fns";

const relativeDate = (date) => formatDistance(parseISO(date), new Date(), { addSuffix: true });

console.log(relativeDate)
const formatDate = (date) => format(new Date(date), 'dd/mm/yyyy')

export { relativeDate , formatDate};

