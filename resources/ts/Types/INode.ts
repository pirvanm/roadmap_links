import { IRoadmap } from "./IRoadmap";

export interface INode {
    roadmap: IRoadmap | null;
    parent: INode;
    name: string | null;
    description: string | null;
    created_at: string;
}