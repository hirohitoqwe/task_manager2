import Label from "./Label";

export default class Task {
    id: number;
    title: string;
    description: string;
    active: boolean;
    labels: Array<Label>;
}
