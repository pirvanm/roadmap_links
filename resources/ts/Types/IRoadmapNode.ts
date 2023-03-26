import { IRoadmap } from "./IRoadmap";

export interface IRoadmapNode {
    roadmap: IRoadmap | null;
    parent: IRoadmapNode;
    name: string | null;
    created_at: string;
}