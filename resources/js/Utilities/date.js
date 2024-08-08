import { formatDistance, parseISO, format } from "date-fns";

const relativeDate = (date) => formatDistance(parseISO(date), new Date(), { addSuffix: true });

const formatDate = (date) => format(new Date(date), 'dd/MM/yyyy')

export { relativeDate , formatDate};

